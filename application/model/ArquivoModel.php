<?php
    class ArquivoModel {
        function __construct($db)
        {
            require_once APP . 'util/Util.php';
            try {
                $this->db = $db;
            } catch (PDOException $e) {
                exit('Database connection could not be established.');
            }
        }

        public function buscarArquivosPorDisciplinaProfessorCursoAnoFilialInstituicao($cdDisciplina,$cdProfessor,$cdCurso, $cdInstituicao, $cdFilial, $cdAno){
            $sql = "select * from arquivo,aux_disciplina_arquivo,disciplina,aux_professor_disciplina,professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
                    where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
                    and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
                    and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
                    and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
                    and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
                    and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
                    and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
                    and professor.CD_PROFESSOR = aux_professor_disciplina.FK_CD_PROFESSOR
                    and disciplina.CD_DISCIPLINA = aux_professor_disciplina.FK_CD_DISCIPLINA
                    and disciplina.CD_DISCIPLINA = aux_disciplina_arquivo.FK_CD_DISCIPLINA
                    and arquivo.CD_ARQUIVO = aux_disciplina_arquivo.FK_CD_ARQUIVO
                    and curso.CD_CURSO = :cd_curso
                    and instituicao.CD_INSTITUICAO = :cd_instituicao
                    and filial.CD_FILIAL = :cd_filial
                    and ano.CD_ANO = :cd_ano
                    and professor.CD_PROFESSOR = :cd_professor
                    and disciplina.CD_DISCIPLINA =:cd_disciplina";
            $query = $this->db->prepare($sql);
            $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor, ':cd_disciplina'=>$cdDisciplina );
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function buscarArquivosPorDisciplinaProfessorCursoAnoFilialInstituicaoAtivos($cdDisciplina,$cdProfessor,$cdInstituicao, $cdFilial, $cdAno ,$cdCurso){
            $sql = "select arquivo.NOME NMARQUIVO, arquivo.*, instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
                    ano.nome NOME_ANO, curso.NOME NOME_CURSO, professor.NOME NOME_PROFESSOR, disciplina.NOME NOME_DISCIPLINA
                    from arquivo,aux_disciplina_arquivo,disciplina,aux_professor_disciplina,professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
                    where filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
                    and filial.CD_FILIAL = aux_ano_filial.FK_CD_FILIAL
                    and ano.CD_ANO = aux_ano_filial.FK_CD_ANO
                    and ano.CD_ANO = aux_ano_curso.FK_CD_ANO
                    and curso.CD_CURSO = aux_ano_curso.FK_CD_CURSO
                    and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO
                    and professor.CD_PROFESSOR = aux_curso_professor.FK_CD_PROFESSOR
                    and professor.CD_PROFESSOR = aux_professor_disciplina.FK_CD_PROFESSOR
                    and disciplina.CD_DISCIPLINA = aux_professor_disciplina.FK_CD_DISCIPLINA
                    and disciplina.CD_DISCIPLINA = aux_disciplina_arquivo.FK_CD_DISCIPLINA
                    and arquivo.CD_ARQUIVO = aux_disciplina_arquivo.FK_CD_ARQUIVO
                    and curso.CD_CURSO = :cd_curso
                    and instituicao.CD_INSTITUICAO = :cd_instituicao
                    and filial.CD_FILIAL = :cd_filial
                    and ano.CD_ANO = :cd_ano
                    and professor.CD_PROFESSOR = :cd_professor
                    and disciplina.CD_DISCIPLINA =:cd_disciplina
                    and arquivo.estado = 1";
            $query = $this->db->prepare($sql);
            $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor, ':cd_disciplina'=>$cdDisciplina );
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function buscarTodosOsArquivos(){
            $sql = "SELECT ARQUIVO.* FROM ARQUIVO";
            $query = $this->db->prepare($sql);
            $query->execute(array());
            return $query->fetchAll();
        }
        public function buscarNomeDisciplinaByArquivo($cdArquivo){
            $sql = "SELECT DISCIPLINA.NOME FROM DISCIPLINA
              INNER JOIN aux_disciplina_arquivo ON DISCIPLINA.CD_DISCIPLINA = aux_disciplina_arquivo.FK_CD_DISCIPLINA
              WHERE aux_disciplina_arquivo.FK_CD_ARQUIVO = :cdArquivo";
            $query = $this->db->prepare($sql);
            $query->execute(array(':cdArquivo' => $cdArquivo));
          //  return $query->fetchAll(PDO::FETCH_ASSOC); // ARRAY DENTRO DE ARRAY
            return $query->fetchAll();
        }
    }

?>
