<?php

class AuxiliarDisciplinaArquivo{

    function __construct($db){
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function salvarDisciplinaArquivo($cdArquivo, $cdDisciplina){
        $sql = "INSERT INTO aux_disciplina_arquivo (fk_cd_arquivo, fk_cd_disciplina) values (:cdArquivo, :cdDisciplina)";
        $query = $this->db->prepare($sql);
        $parameters = array(':cdArquivo' => $cdArquivo, ':cdDisciplina' => $cdDisciplina);
        $retorno = $query->execute($parameters);
        return true;
    }

    public function listarArquivosRelacionados($cdDisciplina){
        $sql = "select * from arquivo where cd_arquivo in (select fk_cd_arquivo from aux_disciplina_arquivo where fk_cd_disciplina = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdDisciplina);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    

    public function listarAnosNaoRelacionados($cdDisciplina){
        $sql = "select * from arquivo where cd_arquivo not in ( select fk_cd_arquivo from aux_disciplina_arquivo where fk_cd_disciplina = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdDisciplina);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function deletarFilialAno($cdAqruivo){
        $sql = "delete from aux_disciplina_arquivo where fk_cd_arquivo = :fk_cd_arquivo";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdAqruivo);
        $query->execute($parameters);
        return true;

    }

    
}
?>