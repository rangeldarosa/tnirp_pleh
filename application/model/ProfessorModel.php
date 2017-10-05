<?php

class ProfessorModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function buscarTodosProfessores()
    {
        $sql = "SELECT * FROM professor";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function salvarProfessor($professor){

        $sql = "INSERT INTO professor (NOME, ESTADO, PRIVADO) values (:nome, :estado, :privado)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $professor["nome"], ':estado' => intval($professor["estado"]), ':privado' =>  intval($professor["privado"]));
        $query->execute($parameters);
    }

}