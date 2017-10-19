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

    public function excluirCurso($curso){
        $sql = "DELETE FROM curso WHERE CD_CURSO = :cd_curso";
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
            ':cd_curso' => $curso["cd_curso"],
        );

        $retorno = $query->execute($parameters);
        var_dump($retorno);
        return true;
    }
}
?>