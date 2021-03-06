<?php

class FilialModel {

    function __construct($db) {
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function buscarTodosAsFiliais() {
        $sql = "SELECT f.*, inst.NOME_INSTITUICAO, cid.NOME_CIDADE, cid.ESTADO nmestado FROM filial f
              INNER JOIN cidade cid ON f.Cidade_CD_CIDADE = cid.CD_CIDADE
              INNER JOIN instituicao inst ON inst.CD_INSTITUICAO = f.Instituicao_CD_INSTITUICAO";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function salvarFilial($filial) {
        $sql = "INSERT INTO filial (NOME, TAXA_IMPRESSAO_COLORIDA,  TAXA_IMPRESSAO_PRETO_E_BRANCO, FILA, ESTADO, Instituicao_CD_INSTITUICAO, Cidade_CD_CIDADE)
        values (:nome, :taxa_impressao_colorida, :taxa_impressao_preto_e_branco, :fila, :estado, :cd_instituicao, :cd_cidade)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $filial["nome"], ':taxa_impressao_colorida' => doubleval($filial["impc"]),
        ':taxa_impressao_preto_e_branco' => doubleval($filial["imppb"]), ':cd_cidade' =>  intval($filial["cidade"]),
        ':cd_instituicao' =>  intval($filial["instituicao"]),':estado' =>  intval($filial["status"]),':fila' => 0);
        $retorno = $query->execute($parameters);
        return true;
    }

    public function buscarFilialPorCd($id) {
      $sql = "SELECT f.*, inst.NOME_INSTITUICAO, cid.NOME_CIDADE, cid.ESTADO nmestado FROM filial f
            INNER JOIN cidade cid ON f.Cidade_CD_CIDADE = cid.CD_CIDADE
            INNER JOIN instituicao inst ON inst.CD_INSTITUICAO = f.Instituicao_CD_INSTITUICAO
            WHERE CD_FILIAL = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function buscarFilialPorInsituicaoCombo($id) {
      $sql = "SELECT f.*, cid.NOME_CIDADE, cid.ESTADO nmestado FROM filial f
            INNER JOIN cidade cid ON f.Cidade_CD_CIDADE = cid.CD_CIDADE
            WHERE f.Instituicao_CD_INSTITUICAO = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function buscarFilialPorInsituicaoAtivo($id) {
      $sql = "SELECT f.*, cid.NOME_CIDADE, cid.ESTADO nmestado,
            inst.NOME_INSTITUICAO
            FROM filial f
            INNER JOIN cidade cid ON f.Cidade_CD_CIDADE = cid.CD_CIDADE
            INNER JOIN instituicao inst ON f.Instituicao_CD_INSTITUICAO = inst.CD_INSTITUICAO
            WHERE f.Instituicao_CD_INSTITUICAO = :cd AND f.ESTADO=1
            ORDER BY f.nome ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => $id);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function bloquearFilial($cdFilial) {
        $sql = "UPDATE filial SET ESTADO = 0 WHERE CD_FILIAL = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdFilial));
        $retorno = $query->execute($parameters);
        var_dump($retorno);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso", null, "Filial bloqueada com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao bloquear filial", "ERROR NO UPDATE", "Algo errado no update da filial");
        }
        header('location: ' . URL . 'filial/');
    }

    public function desbloquearFilial($cdFilial) {
        $sql = "UPDATE filial SET ESTADO = 1 WHERE CD_FILIAL = :cd";
        $query = $this->db->prepare($sql);
        $parameters = array(':cd' => intval($cdFilial));
        $retorno = $query->execute($parameters);
        var_dump($retorno);
        if($retorno){
            Util::retornarMensagemSucesso("Sucesso", null, "Filial desbloqueada com sucesso");
        }else{
            Util::retornarMensagemErro("Erro ao desbloquear filial", "ERROR NO UPDATE", "Algo errado no update da filial");
        }
        header('location: ' . URL . 'filial/');
    }

    public function editarFilial($filial, $cdFilial) {
        $sql = "UPDATE FILIAL SET NOME=:nome, TAXA_IMPRESSAO_COLORIDA = :taxa_impressao_colorida,  TAXA_IMPRESSAO_PRETO_E_BRANCO = :taxa_impressao_preto_e_branco,
        ESTADO = :estado, Instituicao_CD_INSTITUICAO = :cd_instituicao, Cidade_CD_CIDADE = :cd_cidade
        WHERE CD_FILIAL=:cd";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':nome' => $filial["nome"],
            ':taxa_impressao_colorida' => doubleval($filial["impc"]),
            ':taxa_impressao_preto_e_branco' => doubleval($filial["imppb"]),
            ':estado' =>  intval($filial["status"]),
            ':cd_instituicao' =>  intval($filial["instituicao"]),
            ':cd_cidade' =>  intval($filial["cidade"]),
            ':cd' =>  intval($cdFilial)
        );
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }

    public function listarUltimaFilialSalva(){
        $sql = "SELECT * FROM filial ORDER BY CD_FILIAL DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
?>
