<?php

class AuxiliarFilialAnoModel{

    function __construct($db){
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function salvarAuxFilialAno($filial, $ano){
        foreach($filial['anos'] as $anos){
            $sql = "INSERT INTO aux_ano_filial (fk_cd_ano, fk_cd_filial) values (:ano, :filial)";
            $query = $this->db->prepare($sql);
            $parameters = array(':filial' => $filial["cd_filial"], ':ano' => $anos);
            $retorno = $query->execute($parameters);
        }
        return true;
    }

    public function listarAnosRelacionados($cdFilial){
        $sql = "select * from ano where cd_ano in (select fk_cd_ano from aux_ano_filial where fk_cd_filial = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdFilial);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    

    public function listarAnosNaoRelacionados($cdFilial){
        $sql = "select * from ano where cd_ano not in ( select fk_cd_ano from aux_ano_filial where fk_cd_filial = :cd );";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdFilial);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function deletarFilialAno($filial, $ano){
        $sql = "delete from aux_ano_filial where fk_cd_ano = :fk_cd_ano";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdFilial);
        $query->execute($parameters);
        return $query->fetchAll();

    }

    
}
?>