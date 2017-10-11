<?php

class InstituicaoModel
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

    public function salvarInstituicao($instituicao){
            $sql = "INSERT INTO instituicao (NOME_INSTITUICAO) values (:nome)";
            $query = $this->db->prepare($sql);
            $parameters = array(':nome' => $instituicao["nome"]);
            $retorno = $query->execute($parameters);
            var_dump($retorno);
            return true;
    }

    public function buscarTodosAsInstituicoes()
    {
        $sql = "SELECT * FROM instituicao";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
?>