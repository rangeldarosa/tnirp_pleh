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
        $sql = "SELECT nome FROM professor";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

}