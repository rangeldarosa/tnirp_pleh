<?php

class CursoModel{

    function __construct($db){
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function salvarCurso($curso){
            $sql = "INSERT INTO curso (NOME,ESTADO) values (:nome, :estado)";
            $query = $this->db->prepare($sql);
            $parameters = array(':nome' => $curso["nome"], ':estado' => $curso["estado"]);
            $retorno = $query->execute($parameters);
            var_dump($retorno);
            return true;
    }

    public function listarCursos(){
        $sql = "SELECT * FROM curso";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function listarUltimoCursoSalvo(){
        $sql = "SELECT * FROM curso ORDER BY CD_CURSO DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarCursoPorCodigo($codigoCurso){
        $sql = "SELECT * FROM curso WHERE cd_curso = :curso ";
        $query = $this->db->prepare($sql);
        $parameters = array('curso'=>$codigoCurso);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function listarCursosAtivos(){
        $sql = "SELECT * FROM curso WHERE estado != 0";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function desativarCurso($curso){
        $sql = "UPDATE curso SET ESTADO = 0 WHERE CD_CURSO = :cd_curso";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $curso["cd_curso"]);
        $retorno = $query->execute($parameters);
        return true;
    }

    public function ativarCurso($curso){
        $sql = "UPDATE curso SET ESTADO = 1 WHERE CD_CURSO = :cd_curso";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $curso["cd_curso"]);
        $retorno = $query->execute($parameters);
        return true;
    }

    public function alterarCurso($curso){
        $sql = "UPDATE curso SET NOME = :nome, ESTADO = :estado WHERE CD_CURSO = :cd_curso";
        $query = $this->db->prepare($sql);
        
        $parameters = array(
            ':nome' => $curso["nome"], 
            ':estado' => $curso["estado"],
            ':cd_curso' => $curso["codigo"],
        );
        $retorno = $query->execute($parameters);
        return true;
    }
}
?>