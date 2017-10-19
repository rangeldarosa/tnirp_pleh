<?php

class DisciplinaModel   
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

    public function buscarTodasDisciplinas()
    {
        $sql = "SELECT * FROM disciplina";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function salvarDisciplina($disciplina){
        
                $sql = "INSERT INTO disciplina (NOME, ESTADO, PRIVADO) values (:nome, :estado, :privado)";
                $query = $this->db->prepare($sql);
                $parameters = array(':nome' => $disciplina["nome"], ':estado' => intval($disciplina["estado"]), ':privado' =>  intval($disciplina["privado"]));
                $retorno = $query->execute($parameters);
                return true;
    }

    public function editarDisciplina($disciplina, $cdDisciplina){
        $sql = "UPDATE disciplina SET NOME=:nome, ESTADO=:estado, PRIVADO=:privado WHERE cd_disciplina=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $disciplina["nome"], ':estado' => intval($disciplina["estado"]), ':privado' =>  intval($disciplina["privado"]), 'cd' => intval($cdDisciplina));
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }

    public function listarDisciplina($id){
        $sql = "SELECT * FROM disciplina where cd_disciplina = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function bloquearDisciplina($cdDisciplina){
        $sql = "UPDATE disciplina SET ESTADO = 0 WHERE cd_disciplina = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdDisciplina));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Disciplina bloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear Disciplina", "ERROR NO UPDATE", "Algo errado no update da disciplina");
        }
        header('location: ' . URL . 'disciplina/');
    }
    public function desbloquearProfessor($cdDisciplina){
        $sql = "UPDATE disciplina SET ESTADO = 1 WHERE cd_disciplina = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdDisciplina));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Disciplina desbloqueado com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear Disciplina", "ERROR NO UPDATE", "Algo errado no update da disciplina");
        }
        header('location: ' . URL . 'disciplina/');
    }
}