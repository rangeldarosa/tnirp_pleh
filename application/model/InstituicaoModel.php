<?php

class InstituicaoModel
{

    function __construct($db)
    {
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function salvarInstituicao($instituicao){
            $sql = "INSERT INTO instituicao (NOME_INSTITUICAO) values (:nome)";
            $query = $this->db->prepare($sql);
            $parameters = array(':nome' => $instituicao["nome"]);
            $retorno = $query->execute($parameters);
            if($retorno){
                Util::retornarMensagemSucesso("Sucesso!", null, "Instituição cadastrada com sucesso");
            }else{
                Util::retornarMensagemErro("Erro ao bloquear instituição", "ERROR NO UPDATE", "Algo errado no update do instituição");
            }
            header('location: ' . URL . 'instituicao/');
    }

    public function buscarInstituicaoPorCd($id){
        $sql = "SELECT * FROM instituicao where cd_instituicao = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function buscarTodosAsInstituicoes()
    {
        $sql = "SELECT * FROM instituicao";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function buscarTodosAsInstituicoesAtivas() {
        $sql = "SELECT * FROM instituicao WHERE instituicao.ESTADO=1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    // BUSCA CASO TENHA UMA FILIAL
    public function findInstituicoesWhileHaveFilial() {
        $sql = "SELECT instituicao.* FROM instituicao
                WHERE instituicao.ESTADO=1 AND
                (SELECT count(1) FROM filial f
                      INNER JOIN cidade cid ON f.Cidade_CD_CIDADE = cid.CD_CIDADE
                      WHERE f.Instituicao_CD_INSTITUICAO = instituicao.CD_INSTITUICAO) > 0
                ORDER BY instituicao.NOME_INSTITUICAO ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function editarInstituicao($instituicao, $cdInstituicao){
        $sql = "UPDATE instituicao SET NOME_INSTITUICAO=:nome, ESTADO=:estado WHERE CD_INSTITUICAO=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $instituicao["nome"], ':estado' => $instituicao["estado"], ':cd' => intval($cdInstituicao));
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }

    public function bloquearInstituicao($cdInstituicao){
        $sql = "UPDATE instituicao SET ESTADO = 0 WHERE CD_INSTITUICAO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdInstituicao));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Instituição bloqueada com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear instituição", "ERROR NO UPDATE", "Algo errado no update do instituição");
        }
        header('location: ' . URL . 'instituicao/');
    }
    public function desbloquearInstituicao($cdInstituicao){
        $sql = "UPDATE instituicao SET ESTADO = 1 WHERE CD_INSTITUICAO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdInstituicao));
        $retorno = $query->execute($parameters);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso!", null, "Instituição desbloqueada com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear instituição", "ERROR NO UPDATE", "Algo errado no update do instituição");
        }
        header('location: ' . URL . 'instituicao/');
    }

}
?>
