<?php

class AuxiliarCursoProfessor
{

    function __construct($db)
    {
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function listarProfessoresRelacionados($cdCurso){
        $sql = "select * from professor where cd_professor in ( select fk_cd_professor from aux_curso_professor where fk_cd_curso = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdCurso);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    

    public function listarProfessoresNaoRelacionados($cdCurso){
        $sql = "select * from professor where cd_professor not in ( select fk_cd_professor from aux_curso_professor where fk_cd_curso = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdCurso);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    
    public function deletarCursoProfessor($idCurso){
        $sql = "DELETE FROM aux_curso_professor WHERE FK_CD_CURSO = :codigo ";
        $query = $this->db->prepare($sql);
        $parameters = array(':codigo' => $idCurso);
        $retorno = $query->execute($parameters);
        return true;
    } 

    public function salvarAuxiliarCursoProfessor($curso){
        $retorno = "";
        var_dump($curso);
        foreach($curso['professores'] as $professor){
            $sql = "INSERT INTO aux_curso_professor(FK_CD_CURSO,FK_CD_PROFESSOR) VALUES (:curso,:professor)";
            $query = $this->db->prepare($sql);
            $parameters = array(':curso' => $curso["codigo"], ':professor' => $professor["codigo"]);
            $retorno = $query->execute($parameters);
        }
        return true;
    }
}
?>