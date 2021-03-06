<?php

class UsuarioModel {

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function buscarTodosOsUsuarios(){
        $sql = "SELECT usuario.*, filial.nome nome_filial FROM usuario
                INNER JOIN filial ON filial.CD_FILIAL = usuario.FK_CD_FILIAL";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarUsuarioPorCd($id){
        $sql = "SELECT *, filial.nome nome_filial FROM usuario
                INNER JOIN filial ON filial.CD_FILIAL = usuario.FK_CD_FILIAL
                WHERE cd_usuario = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function salvarUsuario($usuario){
        $sql = "INSERT INTO usuario (LOGIN, SENHA, NIVEL_DE_ACESSO, ESTADO, FK_CD_FILIAL) values (:nome, :senha, :nivel_de_acesso, :estado, :fk_cd_filial)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $usuario["nome"], ':senha' => $usuario["senha"], ':nivel_de_acesso' => intval($usuario["nivel_de_acesso"]),':fk_cd_filial'=>intval($usuario["cadUsuarioFilial"]) ,':estado' => intval($usuario["estado"]));
        $retorno = $query->execute($parameters);
        return true;
    }

    public function bloquearUsuario($cdUsuario){
        $sql = "UPDATE usuario SET ESTADO = 0 WHERE CD_USUARIO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdUsuario));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Usuário bloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear Usuario", "ERROR NO UPDATE", "Algo errado no update do Usuario");
        }
        header('location: ' . URL . 'usuario/');
    }
    public function desbloquearUsuario($cdUsuario){
        $sql = "UPDATE usuario SET ESTADO = 1 WHERE CD_USUARIO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdUsuario));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Usuário desbloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear Usuario", "ERROR NO UPDATE", "Algo errado no update do Usuario");
        }
        header('location: ' . URL . 'usuario/');
    }

    public function editarUsuario($usuario, $cdUsuario){
        $sql = "UPDATE usuario SET LOGIN=:login, SENHA=:senha, NIVEL_DE_ACESSO=:nivel_de_acesso, ESTADO=:estado, FK_CD_FILIAL=:fk_cd_filial WHERE cd_usuario=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $usuario["login"],
          ':senha' => $usuario["senha"],
          ':nivel_de_acesso' => intval($usuario["nivel_de_acesso"]),
          ':estado' => intval($usuario["estado"]),
          ':fk_cd_filial' => intval($usuario["cadUsuarioFilial"]),
          'cd' => intval($cdUsuario));
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }
}
