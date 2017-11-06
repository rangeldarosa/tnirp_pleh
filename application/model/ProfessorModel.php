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

    public function buscarProfessorPorCursoAnoFilialInstituicao($cdCurso, $cdInstituicao, $cdFilial, $cdAno){
        $sql = "select professor.*,
                instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
                ano.nome NOME_ANO, curso.NOME NOME_CURSO
                from professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
                where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
                and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
                and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
                and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
                and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
                and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
                and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
                and curso.CD_CURSO = :cd_curso
                and instituicao.CD_INSTITUICAO = :cd_instituicao
                and filial.CD_FILIAL = :cd_filial
                and ano.CD_ANO = :cd_ano; ";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno );
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function buscarProfessorPorCursoAnoFilialInstituicaoAtivos($cdInstituicao, $cdFilial, $cdAno, $cdCurso){
        $sql = "select professor.*,
                instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
                ano.nome NOME_ANO, curso.NOME NOME_CURSO
                from professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
                where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
                and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
                and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
                and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
                and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
                and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
                and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
                and curso.CD_CURSO = :cd_curso
                and instituicao.CD_INSTITUICAO = :cd_instituicao
                and filial.CD_FILIAL = :cd_filial
                and ano.CD_ANO = :cd_ano
                and professor.estado = 1 ";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno );
        $query->execute($parameters);
        return $query->fetchAll();
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
