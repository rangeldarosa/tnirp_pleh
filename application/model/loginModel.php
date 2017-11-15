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
        $sql = "SELECT usuario.cd_usuario, usuario.login, usuario.senha, usuario.nivel_de_acesso,
                       usuario.estado, usuario.fk_cd_filial, filial.nome nome_filial,
                       filial.taxa_impressao_colorida, filial.taxa_impressao_preto_e_branco taxa_impressao_pb
                FROM usuario
                  INNER JOIN FILIAL ON filial.CD_FILIAL = usuario.FK_CD_FILIAL
                WHERE login = :login AND senha = :senha ";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':senha' => $senha);
        $query->execute($parameters);
        return $query->fetch();
    }

}
