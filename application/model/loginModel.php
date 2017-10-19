<?php

class LoginModel {

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function validarLogin($login, $senha) {
        $sql = "SELECT cd_usuario, login, senha, estado FROM usuario where login = :login and senha = :senha ";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':senha' => $senha);
        $query->execute($parameters);

        return $query->fetch();
    }

}
