<?php

class FilialModel
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



    public function salvarFilial($filial){
        $sql = "INSERT INTO filial (NOME, TAXA_IMPRESSAO_COLORIDA,  TAXA_IMPRESSAO_PRETO_E_BRANCO, FILA, ESTADO, Instituicao_CD_INSTITUICAO, Cidade_CD_CIDADE) 
        values (:nome, :taxa_impressao_colorida, :taxa_impressao_preto_e_branco, :fila, :estado, :cd_instituicao, :cd_cidade)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $filial["nome"], ':taxa_impressao_colorida' => doubleval($filial["impc"]),
        ':taxa_impressao_preto_e_branco' => doubleval($filial["imppb"]), ':cd_cidade' =>  intval($filial["cidade"]),
        ':cd_instituicao' =>  intval($filial["instituicao"]),':estado' =>  intval($filial["status"]),':fila' => 0);
        $retorno = $query->execute($parameters);
        return true;
    }
}
?>