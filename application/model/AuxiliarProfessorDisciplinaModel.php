<?php

class AuxiliarProfessorDisciplinaModel
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

    public function listarDisciplinasRelacionadas($cdProfessor){
        $sql = "select * from disciplina where cd_disciplina in (select fk_cd_disciplina from aux_professor_disciplina where fk_cd_professor = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdProfessor);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    

    public function listarDisciplinasNaoRelacionadas($cdProfessor){
        $sql = "select * from disciplina where cd_disciplina not in ( select fk_cd_disciplina from aux_professor_disciplina where fk_cd_professor = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdProfessor);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    
}
?>