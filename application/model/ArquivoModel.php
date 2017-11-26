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
            $sql = "SELECT * from arquivo,aux_disciplina_arquivo,disciplina,aux_professor_disciplina,professor, aux_curso_professor, curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
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
                    ORDER BY arquivo.nome ASC";
            $query = $this->db->prepare($sql);
            $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor, ':cd_disciplina'=>$cdDisciplina );
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function buscarArquivosPorDisciplinaProfessorCursoAnoFilialInstituicaoAtivos($cdDisciplina,$cdProfessor,$cdInstituicao, $cdFilial, $cdAno ,$cdCurso){
            if(intval($_SESSION["usuario"]->Instituicao_CD_INSTITUICAO)==$cdInstituicao || intval($_SESSION["usuario"]->nivel_de_acesso)==3 ){
                $sql = "SELECT arquivo.NOME NMARQUIVO, arquivo.*, instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
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
                        and arquivo.estado = 1
                        ORDER BY arquivo.nome ASC";
            }else{
                $sql = "SELECT arquivo.NOME NMARQUIVO, arquivo.*, instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
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
                        and arquivo.estado = 1
                        and arquivo.privado = 0
                        ORDER BY arquivo.nome ASC";
            }
            $query = $this->db->prepare($sql);
            $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor, ':cd_disciplina'=>$cdDisciplina );
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function buscarTodosOsArquivos(){
            $sql = "SELECT distinct arquivo.CD_ARQUIVO, arquivo.CAMINHO_PARA_O_ARQUIVO, arquivo.nome as NOME,(select distinct nome from curso where cd_curso = curso.CD_CURSO limit 1) as NOME_CURSO,
                disciplina.nome as NOME_DISCIPLINA, professor.NOME as NOME_PROFESSOR, ano.NOME as NOME_ANO, (select nome from filial where cd_filial = filial.CD_FILIAL limit 1 ) as NOME_FILIAL, arquivo.PAGINAS, arquivo.ARQUIVO_PRIVADO as ARQUIVO_PRIVADO, arquivo.estado as ESTADO
                from instituicao, filial, aux_ano_filial, ano, aux_ano_curso, curso, aux_curso_professor, professor, aux_professor_disciplina, disciplina, aux_disciplina_arquivo,arquivo
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
                ORDER BY arquivo.nome ASC;";
            $query = $this->db->prepare($sql);
            $query->execute(array());
            return $query->fetchAll();
        }

        public function buscarCaminhoArquivo($cdArquivo){
            $sql = "SELECT arquivo.CAMINHO_PARA_O_ARQUIVO CAMINHO FROM ARQUIVO WHERE CD_ARQUIVO = :cdArquivo";
            $query = $this->db->prepare($sql);
            $query->execute(array(':cdArquivo' => $cdArquivo));
            return $query->fetch();
        }

        public function salvarArquivo($arquivo){
            $sql = "INSERT INTO arquivo(nome,paginas,caminho_para_o_arquivo,arquivo_privado,estado) VALUES "
                ."(:nome,:paginas,:caminho_para_o_arquivo,:arquivo_privado,:estado)";
            $query = $this->db->prepare($sql);
            $parameters = array(
                ':nome' => $arquivo["nome"],
                ':paginas' => $arquivo["paginas"],
                ':caminho_para_o_arquivo' => $arquivo["caminho_para_o_arquivo"],
                ':arquivo_privado' => $arquivo["arquivo_privado"],
                ':estado' => $arquivo["estado"]
            );
            $retorno = $query->execute($parameters);
            return true;
        }

        public function buscarArquivoPorCodigo($cdArquivo){
            $sql = "SELECT * FROM arquivo WHERE cd_arquivo = :cd_arquivo";
            $query = $this->db->prepare($sql);
            $parameters = array(':cd_arquivo' =>$cdArquivo);
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function findFileForPrint($idDisciplina, $idProfessor, $idInstituicao, $idFilial, $idAno, $idCurso, $cdArquivo){
          $sql = "SELECT arquivo.NOME NMARQUIVO, arquivo.*, arquivo.CAMINHO_PARA_O_ARQUIVO, instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
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
                  and disciplina.CD_DISCIPLINA = :cd_disciplina
                  and arquivo.cd_arquivo = :cd_arquivo
                  ORDER BY arquivo.nome ASC";
      $query = $this->db->prepare($sql);
      $parameters = array(':cd_curso' => $idCurso,
                          ':cd_instituicao' => $idInstituicao,
                          ':cd_filial' => $idFilial,
                          ':cd_ano' => $idAno,
                          ':cd_professor' => $idProfessor,
                          ':cd_disciplina' => $idDisciplina,
                          ':cd_arquivo' => $cdArquivo);
      $query->execute($parameters);
      return $query->fetchAll();
        }

        public function buscarUltimoArquivoCadastrado(){
            $sql = "SELECT * FROM arquivo order by cd_arquivo desc limit 1";
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }

        public function bloquearArquivo($cdArquivo){
            $sql = "UPDATE arquivo SET ESTADO = 0 WHERE CD_ARQUIVO = :cd";
            $query = $this->db->prepare($sql);
            $parameters = array(':cd' => intval($cdArquivo));
            $retorno = $query->execute($parameters);
            if($retorno){
                Util::retornarMensagemSucesso("Sucesso!", null, "Arquivo bloqueado com sucesso");
            }else{
                Util::retornarMensagemErro("Erro ao bloquear Arquivo", "ERROR NO UPDATE", "Algo errado no update do arquivo");
            }
            header('location: ' . URL . 'arquivo/');
        }
        public function desbloquearArquivo($cdArquivo){
            $sql = "UPDATE arquivo SET ESTADO = 1 WHERE CD_ARQUIVO = :cd";
            $query = $this->db->prepare($sql);
            $parameters = array(':cd' => intval($cdArquivo));
            $retorno = $query->execute($parameters);
            if($retorno){
                Util::retornarMensagemSucesso("Sucesso!", null, "Arquivo desbloqueado com sucesso");
            }else{
                Util::retornarMensagemErro("Erro ao desbloquear Arquivo", "ERROR NO UPDATE", "Algo errado no update do arquivo");
            }
            header('location: ' . URL . 'arquivo/');
        }

        public function atualizarPaginaArquivo($cdArquivo, $qtPaginas) {
          $sql = "UPDATE arquivo SET PAGINAS = :qtPaginas WHERE CD_ARQUIVO = :cd";
          $query = $this->db->prepare($sql);
          return $retorno = $query->execute(array(':cd' => intval($cdArquivo), ':qtPaginas' => intval($qtPaginas)));
        }

    }
?>
