<?php

class ProfessorModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        require_once APP . 'util/Util.php';
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
        $retorno = $query->execute($parameters);
        return true;
    }
    public function editarProfessor($professor, $cod){
        $sql = "UPDATE PROFESSOR SET NOME=:nome, ESTADO=:estado, PRIVADO=:privado WHERE cd_professor=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $professor["nome"], ':estado' => intval($professor["estado"]), ':privado' =>  intval($professor["privado"]), 'cd' => intval($cod));
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }

    public function buscarProfessorPorCd($id){
        $sql = "SELECT * FROM professor where cd_professor = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function bloquearProfessor($cdProfessor){
        $sql = "UPDATE professor SET ESTADO = 0 WHERE CD_PROFESSOR = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdProfessor));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Professor, bloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear professor");
        }
        header('location: ' . URL . 'professor/');
    }
    public function desbloquearProfessor($cdProfessor){
        $sql = "UPDATE professor SET ESTADO = 1 WHERE CD_PROFESSOR = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdProfessor));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Professor, desbloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloqueado professor");
        }
        header('location: ' . URL . 'professor/');
    }

}
