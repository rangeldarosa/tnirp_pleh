<?php

class CursoModel{

    function __construct($db){
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function salvarCurso($curso){
            $sql = "INSERT INTO curso (NOME,ESTADO) values (:nome, :estado)";
            $query = $this->db->prepare($sql);
            $parameters = array(':nome' => $curso["nome"], ':estado' => $curso["estado"]);
            $retorno = $query->execute($parameters);
            var_dump($retorno);
            return true;
    }

    public function buscarCursoPorAnoFilialInstituicao($cdInstituicao, $cdFilial, $cdAno){
        $sql = "SELECT curso.*,
        instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
        ano.nome NOME_ANO
        from curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
        where curso.cd_curso = aux_ano_curso.fk_cd_curso
        and ano.cd_ano = aux_ano_curso.fk_cd_ano
        and ano.cd_ano = aux_ano_filial.fk_cd_ano
        and filial.cd_filial = aux_ano_filial.fk_cd_filial
        and filial.Instituicao_CD_INSTITUICAO = :cd_instituicao
        and filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
        and filial.cd_filial = :cd_filial
        and ano.cd_ano = :cd_ano
        ORDER BY curso.nome ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno );
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function buscarCursoPorAnoFilialInstituicaoAtivos($cdInstituicao, $cdFilial, $cdAno){
        $sql = "SELECT curso.*,
        instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
        ano.nome NOME_ANO
        from curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
        where curso.cd_curso = aux_ano_curso.fk_cd_curso
        and ano.cd_ano = aux_ano_curso.fk_cd_ano
        and ano.cd_ano = aux_ano_filial.fk_cd_ano
        and filial.cd_filial = aux_ano_filial.fk_cd_filial
        and filial.Instituicao_CD_INSTITUICAO = :cd_instituicao
        and filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
        and filial.cd_filial = :cd_filial
        and ano.cd_ano = :cd_ano
        and curso.ESTADO = 1
        ORDER BY curso.nome ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno );
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function buscarCursoPorAnoFilialInstituicaoAtivo($cdInstituicao, $cdFilial, $cdAno){
        $sql = "SELECT curso.*,
        instituicao.NOME_INSTITUICAO, filial.NOME NOME_FILIAL,
        ano.nome NOME_ANO
        from curso, aux_ano_curso, ano, aux_ano_filial, filial, instituicao
        where curso.cd_curso = aux_ano_curso.fk_cd_curso
        and ano.cd_ano = aux_ano_curso.fk_cd_ano
        and ano.cd_ano = aux_ano_filial.fk_cd_ano
        and filial.cd_filial = aux_ano_filial.fk_cd_filial
        and filial.Instituicao_CD_INSTITUICAO = :cd_instituicao
        and filial.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO
        and filial.cd_filial = :cd_filial
        and ano.cd_ano = :cd_ano
        and curso.ESTADO = 1
        ORDER BY curso.nome ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_instituicao' =>$cdInstituicao, ':cd_filial'=>$cdFilial, ':cd_ano'=>$cdAno);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function listarCursos(){
        $sql = "SELECT * FROM curso";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function listarUltimoCursoSalvo(){
        $sql = "SELECT * FROM curso ORDER BY CD_CURSO DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarCursoPorCodigo($codigoCurso){
        $sql = "SELECT * FROM curso WHERE cd_curso = :curso ";
        $query = $this->db->prepare($sql);
        $parameters = array('curso'=>$codigoCurso);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function listarCursosAtivos(){
        $sql = "SELECT * FROM curso WHERE estado != 0";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function desativarCurso($curso){
        $sql = "UPDATE curso SET ESTADO = 0 WHERE CD_CURSO = :cd_curso";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $curso["cd_curso"]);
        $retorno = $query->execute($parameters);
        return true;
    }

    public function ativarCurso($curso){
        $sql = "UPDATE curso SET ESTADO = 1 WHERE CD_CURSO = :cd_curso";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd_curso' => $curso["cd_curso"]);
        $retorno = $query->execute($parameters);
        return true;
    }

    public function alterarCurso($curso){
        $sql = "UPDATE curso SET NOME = :nome, ESTADO = :estado WHERE CD_CURSO = :cd_curso";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':nome' => $curso["nome"],
            ':estado' => $curso["estado"],
            ':cd_curso' => $curso["codigo"],
        );
        $retorno = $query->execute($parameters);
        return true;
    }
}
?>
