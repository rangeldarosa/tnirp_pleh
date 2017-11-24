<?php
    class AuxiliarAnoCurso {
        function __construct($db)
        {
            require_once APP . 'util/Util.php';
            try {
                $this->db = $db;
            } catch (PDOException $e) {
                exit('Database connection could not be established.');
            }
        }
    
        public function salvarAuxiliarAnoCurso($curso){
            $retorno = "";
            foreach($curso['anos'] as $ano){
                $sql = "INSERT INTO aux_ano_curso(FK_CD_CURSO,FK_CD_ANO) VALUES (:curso,:ano)";
                $query = $this->db->prepare($sql);
                $parameters = array(':curso' => $curso["codigo"], ':ano' => $ano["codigo"]);
                $retorno = $query->execute($parameters);
            }
            return true;
        }
    
        public function listarAnosPorCurso($codigoCurso){
            $sql = "SELECT a.* FROM ano a ";
            $sql += "INNER JOIN aux_ano_curso ac ON (a.CD_ANO = ac.FK_CD_ANO) ";
            $sql += "INNER JOIN curso c ON (c.CD_CURSO = ac.FK_CD_CURSO) ";
            $sql += "WHERE c.CD_CURSO = :codigo ";
            $query = $this->db->prepare($sql);
            $parameters = array(':codigo' => $codigoCurso);
            $query->execute();
            return $query->fetchAll();
        }
        
        public function listarAnosPorNaoRelacionados($codigoCurso){
            $sql = "SELECT * from ano where cd_ano not in (select fk_cd_ano from aux_ano_curso where FK_CD_CURSO = :codigo)";
            $query = $this->db->prepare($sql);
            $parameters = array(':codigo' => codigoCurso);
            $query->execute();
            return $query->fetchAll();
        }
        public function deletarCursoAno($idCurso){
            $sql = "DELETE FROM aux_ano_curso WHERE FK_CD_CURSO = :codigo ";
            $query = $this->db->prepare($sql);
            $parameters = array(':codigo' => $idCurso);
            $retorno = $query->execute($parameters);
            return true;
        } 

    }
?>