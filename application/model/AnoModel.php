<?php

class AnoModel {

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function buscarTodosOsAnos(){
        $sql = "SELECT * FROM ano";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarAnoPorCd($id){
        $sql = "SELECT * FROM ano where cd_ano = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function salvarAno($ano){
        $sql = "INSERT INTO ano (NOME, ESTADO) values (:nome, :estado)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $ano["nome"], ':estado' => $ano["estado"]);
        $retorno = $query->execute($parameters);    
        var_dump($retorno);
        return true;
    }


    public function bloquearAno($cdAno){
        $sql = "UPDATE ano SET ESTADO = 0 WHERE CD_ANO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdAno));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Ano bloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear Ano", "ERROR NO UPDATE", "Algo errado no update do Ano");
        }
        header('location: ' . URL . 'ano/');
    }
    public function desbloquearAno($cdAno){
        $sql = "UPDATE ano SET ESTADO = 1 WHERE CD_ANO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdAno));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Ano desbloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear Ano", "ERROR NO UPDATE", "Algo errado no update do Ano");
        }
        header('location: ' . URL . 'ano/');
    }

    public function editarAno($ano, $cdAno){
        $sql = "UPDATE ano SET NOME=:nome, ESTADO=:estado WHERE cd_ano=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $ano["nome"], ':estado' => intval($ano["estado"]), 'cd' => intval($cdAno));
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }
}
