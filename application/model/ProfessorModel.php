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

    public function editarProfessor($professor, $cdProfessor){
        $sql = "UPDATE PROFESSOR SET NOME=:nome, ESTADO=:estado, PRIVADO=:privado WHERE cd_professor=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $professor["nome"], ':estado' => intval($professor["estado"]), ':privado' =>  intval($professor["privado"]), 'cd' => intval($cdProfessor));
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
            Util::retornarMensagemSucesso("Sucesso!", null, "Professor bloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear Professor", "ERROR NO UPDATE", "Algo errado no update do professor");
        }
        header('location: ' . URL . 'professor/');
    }
    public function desbloquearProfessor($cdProfessor){
        $sql = "UPDATE professor SET ESTADO = 1 WHERE CD_PROFESSOR = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdProfessor));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Professor desbloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear Professor", "ERROR NO UPDATE", "Algo errado no update do professor");
        }
        header('location: ' . URL . 'professor/');
    }

}
