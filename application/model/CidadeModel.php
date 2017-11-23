<?php

class CidadeModel
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

    public function salvarCidade($cidade){
            $sql = "INSERT INTO cidade (NOME_CIDADE, ESTADO) values (:nome, :estado)";
            $query = $this->db->prepare($sql);
            $parameters = array(':nome' => $cidade["nome"], ':estado' => $cidade["estado"]);
            $retorno = $query->execute($parameters);
            return true;
    }

    public function buscarTodasAsCidades()
    {
        $sql = "SELECT * FROM cidade";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarCidadePor($id){
        $sql = "SELECT * FROM cidade WHERE cd_cidade = :cd ";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function editarCidade($cidade){
        $sql = "update cidade set nome_cidade = :nome, estado = :estado where cd_cidade = :cd_cidade";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $cidade["nome"], ':estado' => $cidade["estado"],':cd_cidade'=>$cidade["codigo"]);
        $retorno = $query->execute($parameters);
        return true;
    }
}
?>
