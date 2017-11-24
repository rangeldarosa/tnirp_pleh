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
    
        public function salvarAuxiliarAnoCurso($cdAno,$ano){
            
            $retorno = "";
            foreach($ano['cursos'] as $curso){
                $sql = "INSERT INTO aux_ano_curso(FK_CD_CURSO,FK_CD_ANO) VALUES (:curso,:ano)";
                $query = $this->db->prepare($sql);
                $parameters = array(':curso' => $curso["codigo"], ':ano' => $cdAno);
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
        
        public function listarCursosRelacionados($cdAno){
            $sql = "SELECT * from curso where cd_curso in (select fk_cd_curso from aux_ano_curso where FK_CD_ANO = :codigo)";
            $query = $this->db->prepare($sql);
            $parameters = array(':codigo' => $cdAno);
            $query->execute($parameters);
            return $query->fetchAll();
        }
        public function listarCursosNaoRelacionados($cdAno){
            $sql = "SELECT * from curso where cd_curso not in (select fk_cd_curso from aux_ano_curso where FK_CD_ANO = :codigo)";
            $query = $this->db->prepare($sql);
            $parameters = array(':codigo' => $cdAno);
            $query->execute($parameters);
            return $query->fetchAll();
        }

        public function deletarAnoCurso($idAno){
            $sql = "DELETE FROM aux_ano_curso WHERE FK_CD_ANO = :codigo ";
            $query = $this->db->prepare($sql);
            $parameters = array(':codigo' => $idAno);
            $retorno = $query->execute($parameters);
            return true;
        } 

    }
?>