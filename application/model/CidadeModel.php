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
            var_dump($retorno);
            return true;
    }

    public function buscarTodasAsCidades()
    {
        $sql = "SELECT * FROM cidade";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
?>