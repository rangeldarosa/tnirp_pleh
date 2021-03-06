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

    public function buscarDisciplinaPorProfessorCursoAnoFilialInstituicao($cdProfessor,$cdCurso, $cdInstituicao, $cdFilial, $cdAno){
        $sql = "SELECT disciplina.*,
                instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
                ano.nome NOME_ANO, curso.NOME NOME_CURSO, professor.NOME NOME_PROFESSOR, disciplina.NOME NOME_DISCIPLINA
                from disciplina,aux_professor_disciplina,professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
                where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
                and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
                and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
                and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
                and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
                and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
                and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
                and professor.CD_PROFESSOR = aux_professor_disciplina.FK_CD_PROFESSOR
                and disciplina.CD_DISCIPLINA = aux_professor_disciplina.FK_CD_DISCIPLINA
                and curso.CD_CURSO = :cd_curso
                and instituicao.CD_INSTITUICAO = :cd_instituicao
                and filial.CD_FILIAL = :cd_filial
                and ano.CD_ANO = :cd_ano
                and professor.CD_PROFESSOR = :cd_professor
                ORDER BY disciplina.nome ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor );
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function buscarDisciplinaPorProfessorCursoAnoFilialInstituicaoAtivos($cdProfessor,$cdInstituicao, $cdFilial, $cdAno, $cdCurso){
        if(intval($_SESSION["usuario"]->Instituicao_CD_INSTITUICAO)==$cdInstituicao || intval($_SESSION["usuario"]->nivel_de_acesso)==3){
            $sql = "SELECT disciplina.*,
                    instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
                    ano.nome NOME_ANO, curso.NOME NOME_CURSO, professor.NOME NOME_PROFESSOR, disciplina.NOME NOME_DISCIPLINA
                    from disciplina,aux_professor_disciplina,professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
                    where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
                    and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
                    and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
                    and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
                    and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
                    and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
                    and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
                    and professor.CD_PROFESSOR = aux_professor_disciplina.FK_CD_PROFESSOR
                    and disciplina.CD_DISCIPLINA = aux_professor_disciplina.FK_CD_DISCIPLINA
                    and curso.CD_CURSO = :cd_curso
                    and instituicao.CD_INSTITUICAO = :cd_instituicao
                    and filial.CD_FILIAL = :cd_filial
                    and ano.CD_ANO = :cd_ano
                    and professor.CD_PROFESSOR = :cd_professor
                    and disciplina.estado = 1
                    ORDER BY disciplina.nome ASC";
        }else{
            $sql = "SELECT disciplina.*,
            instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
            ano.nome NOME_ANO, curso.NOME NOME_CURSO, professor.NOME NOME_PROFESSOR, disciplina.NOME NOME_DISCIPLINA
            from disciplina,aux_professor_disciplina,professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
            where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
            and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
            and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
            and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
            and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
            and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
            and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
            and professor.CD_PROFESSOR = aux_professor_disciplina.FK_CD_PROFESSOR
            and disciplina.CD_DISCIPLINA = aux_professor_disciplina.FK_CD_DISCIPLINA
            and curso.CD_CURSO = :cd_curso
            and instituicao.CD_INSTITUICAO = :cd_instituicao
            and filial.CD_FILIAL = :cd_filial
            and ano.CD_ANO = :cd_ano
            and professor.CD_PROFESSOR = :cd_professor
            and disciplina.estado = 1
            and disciplina.privado = 0
            ORDER BY disciplina.nome ASC";

        }

        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor );
        $query->execute($parameters);
        return $query->fetchAll();
    }


    public function buscarTodasDisciplinas()
    {
        $sql = "SELECT * FROM disciplina";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function buscarDisciplinaPorCd($idDisciplina) {
        $sql = "SELECT * FROM disciplina WHERE cd_disciplina=:cd";
        $query = $this->db->prepare($sql);
        $query->execute(array(':cd' => $idDisciplina));
        return $query->fetchAll();
    }

    public function salvarDisciplina($disciplina) {
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
            Util::retornarMensagemSucesso("Sucesso!", null, "Disciplina bloqueada com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear Disciplina", "ERROR NO UPDATE", "Algo errado no update da disciplina");
        }
        header('location: ' . URL . 'disciplina/');
    }
    public function desbloquearDisciplina($cdDisciplina){
        $sql = "UPDATE disciplina SET ESTADO = 1 WHERE cd_disciplina = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdDisciplina));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Disciplina desbloqueada com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear Disciplina", "ERROR NO UPDATE", "Algo errado no update da disciplina");
        }
        header('location: ' . URL . 'disciplina/');
    }
}
