<?php

class FilaDeImpressaoModel
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


    public function buscarTodasAsRequisicoes(){
        $sql = "SELECT * FROM requisicao";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    public function buscarTodasAsRequisicoesPorFilial($cdFilial){
        $sql = "select * from requisicao
        where FK_USUARIO_CD_FILIAL = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $cdFilial);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function salvarRequisicao($requisicao){
        $sql = "INSERT INTO requisicao (FK_CD_USUARIO, FK_USUARIO_CD_FILIAL, FK_CD_ARQUIVO, DATA, TIPO) values (:cdUsuario, :cdFilial, :cdArquivo, :data, :tipo)";
        $query = $this->db->prepare($sql);
        $parameters = array(':FK_CD_USUARIO' => $requisicao["cdUsuario"], ':FK_USUARIO_CD_FILIAL' => $requisicao["cdfilial"], ':FK_CD_ARQUIVO' => $requisicao["cdArquivo"]
        ':data' => $requisicao["data"], ':tipo' => $requisicao["tipo"]);
        $retorno = $query->execute($parameters);
        var_dump($retorno);
        return true;
    }
?>