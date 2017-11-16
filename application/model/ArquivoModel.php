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
            $query = $this->db->prepare($sql);
            $parameters = array(':cd_curso' => $cdCurso,':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno, ':cd_professor'=>$cdProfessor, ':cd_disciplina'=>$cdDisciplina );
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function buscarTodosOsArquivos(){
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
                    and curso.CD_CURSO = aux_curso_professor.FK_CD_CURSO";
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


        // public function buscarTodosOsArquivos(){
        //     $sql = "SELECT ARQUIVO.* FROM ARQUIVO";
        //     $query = $this->db->prepare($sql);
        //     $query->execute(array());
        //     $arquivos = $query->fetchAll();
        //
        //     // DISCIPLINAS DO ARQUIVO
        //     for ($i=0; $i<count($arquivos); $i++) {
        //       $arquivos[$i]->DISCIPLINAS = $this->buscarNomeDisciplinaByArquivo($arquivos[$i]->CD_ARQUIVO);
        //       for($j=0; $j<count($arquivos[$i]->DISCIPLINAS); $j++) {
        //         $arquivos[$i]->DISCIPLINAS[$j]->PROFESSORES = $this->buscarNomeProfessorByDisciplina($arquivos[$i]->DISCIPLINAS[$j]->CD_DISCIPLINA);
        //         for($k=0; $k<count($arquivos[$i]->DISCIPLINAS[$j]); $k++) {
        //           $arquivos[$i]->DISCIPLINAS[$j]->PROFESSORES[$k]->CURSOS = $this->buscarCursoPorProfessorDisciplinaArquivo($arquivos[$i]->DISCIPLINAS[$j]->CD_DISCIPLINA, $arquivos[$i]->CD_ARQUIVO, $arquivos[$i]->DISCIPLINAS[$j]->PROFESSORES[$k]->CD_PROFESSOR);
        //         }
        //       }
        //     }
        //     return $arquivos;
        // }
        //
        // public function buscarNomeDisciplinaByArquivo($cdArquivo){
        //     $sql = "SELECT DISCIPLINA.NOME, DISCIPLINA.CD_DISCIPLINA FROM DISCIPLINA
        //       INNER JOIN aux_disciplina_arquivo ON DISCIPLINA.CD_DISCIPLINA = aux_disciplina_arquivo.FK_CD_DISCIPLINA
        //       WHERE aux_disciplina_arquivo.FK_CD_ARQUIVO = :cdArquivo";
        //     $query = $this->db->prepare($sql);
        //     $query->execute(array(':cdArquivo' => $cdArquivo));
        //     return $query->fetchAll();
        // }
        //
        // public function buscarNomeProfessorByDisciplina($cdDisciplina){
        //     $sql = "SELECT PROFESSOR.NOME, PROFESSOR.CD_PROFESSOR FROM PROFESSOR
        //             INNER JOIN aux_professor_disciplina ON PROFESSOR.CD_PROFESSOR = aux_professor_disciplina.FK_CD_PROFESSOR
        //             WHERE aux_professor_disciplina.FK_CD_DISCIPLINA = :cdDisciplina";
        //     $query = $this->db->prepare($sql);
        //     $query->execute(array(':cdDisciplina' => $cdDisciplina));
        //     return $query->fetchAll();
        // }
        //
        // public function buscarCursoPorProfessorDisciplinaArquivo($cdDisciplina, $cdArquivo, $cdProfessor){
        //     $sql = "SELECT CURSO.NOME FROM CURSO
        //             INNER JOIN aux_curso_professor ON aux_curso_professor.FK_CD_CURSO = CURSO.CD_CURSO
        //             INNER JOIN disciplina ON disciplina.CD_DISCIPLINA = :cdDisciplina
        //             INNER JOIN aux_disciplina_arquivo ON disciplina.CD_DISCIPLINA = aux_disciplina_arquivo.FK_CD_DISCIPLINA
        //             AND aux_disciplina_arquivo.FK_CD_ARQUIVO = :cdArquivo
        //             WHERE aux_curso_professor.FK_CD_PROFESSOR = :cdProfessor;
        //             ";
        //     $query = $this->db->prepare($sql);
        //     $query->execute(array(':cdDisciplina' => $cdDisciplina, ':cdArquivo' => $cdArquivo, ':cdProfessor' => $cdProfessor));
        //     return $query->fetchAll();
        // }

        public function salvarArquivo($arquivo){
            $sql = "INSERT INTO arquivo(nome,paginas,caminho_para_o_arquivo,arquivo_privado,estado,valor_preto_e_branco,valor_colorido) VALUES "
                ."(:nome,:paginas,:caminho_para_o_arquivo,:arquivo_privado,:estado,:valor_preto_e_branco,:valor_colorido)";
            $query = $this->db->prepare($sql);
            $parameters = array(
                ':nome' => $arquivo["nome"], 
                ':paginas' => $arquivo["paginas"],
                ':caminho_para_o_arquivo' => $arquivo["caminho_para_o_arquivo"],
                ':arquivo_privado' => $arquivo["arquivo_privado"],
                ':estado' => $arquivo["estado"],
                ':valor_preto_e_branco' => $arquivo["valor_preto_e_branco"],
                ':valor_colorido' => $arquivo["valor_colorido"]
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

        public function buscarUltimoArquivoCadastrado(){
            $sql = "SELECT * FROM arquivo order by cd_arquivo desc limit 1";
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }

    }
?>
