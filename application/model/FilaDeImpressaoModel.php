    <?php

class FilaDeImpressaoModel {

    function __construct($db) {
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function changeStatus($cdRequisicao, $status) {
        $sql = "UPDATE REQUISICAO SET STATUSATUAL=:status WHERE CD_REQUISICAO=:cdRequisicao";
        $query = $this->db->prepare($sql);
        $parameters = array(':status' => $status,':cdRequisicao' => $cdRequisicao);
        $retorno = $query->execute($parameters);
        if($retorno){
          return true;
        }else{
          return false;
        }
    }

    public function buscarTodasAsRequisicoesPendentes(){
        $sql = "SELECT REQUISICAO.*, usuario.login nmUsuario, arquivo.nome nmArquivo, arquivo.CAMINHO_PARA_O_ARQUIVO link, filial.nome nmFilial FROM REQUISICAO
                JOIN usuario ON usuario.CD_USUARIO = requisicao.FK_CD_USUARIO
                JOIN arquivo ON arquivo.CD_ARQUIVO = REQUISICAO.FK_CD_ARQUIVO
                JOIN filial ON filial.CD_FILIAL = requisicao.FK_USUARIO_CD_FILIAL
                AND (REQUISICAO.STATUSATUAL >= 0 AND REQUISICAO.STATUSATUAL < 2)";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function buscarTodasAsRequisicoesPendentesPorFilial($cdFilial){
        $sql = "SELECT REQUISICAO.*, usuario.login nmUsuario, arquivo.nome nmArquivo, arquivo.CAMINHO_PARA_O_ARQUIVO link, filial.nome nmFilial FROM REQUISICAO
                JOIN usuario ON usuario.CD_USUARIO = requisicao.FK_CD_USUARIO
                JOIN arquivo ON arquivo.CD_ARQUIVO = REQUISICAO.FK_CD_ARQUIVO
                JOIN filial ON filial.CD_FILIAL = requisicao.FK_USUARIO_CD_FILIAL
                AND (REQUISICAO.STATUSATUAL >= 0 AND REQUISICAO.STATUSATUAL < 2)
                WHERE CD_FILIAL = :cdFilial";
        $query = $this->db->prepare($sql);
        $parameters = array(':cdFilial' => $cdFilial);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function buscarIntervaloPorRequisicao($cdRequisicao){
        $sql = "SELECT REQUISICAO_INTERVALOS.* FROM REQUISICAO_INTERVALOS
                WHERE ID_REQUISICAO = :cdRequisicao";
        $query = $this->db->prepare($sql);
        $parameters = array(':cdRequisicao' => $cdRequisicao);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function salvarRequisicao($requisicao){
        $sql = "INSERT INTO requisicao (FK_CD_USUARIO, FK_USUARIO_CD_FILIAL, FK_CD_ARQUIVO, DATA, tipo, STATUSATUAL, NOME) values (:cdUsuario, :cdFilial, :cdArquivo, now(), 'IMPRESSAO', 0, :nomeUsuario)";
        $query = $this->db->prepare($sql);
        $this->db->beginTransaction();
        $parameters = array(':cdUsuario' => $requisicao["cdUsuario"], ':cdFilial' => $requisicao["cdFilial"], ':cdArquivo' => $requisicao["cdArquivo"], ':nomeUsuario' => $requisicao["nomeUsuario"]);
        $retorno = $query->execute($parameters);
        $idRequisicao = $this->db->lastInsertId(); 
        $this->salvarIntervalo($requisicao["intervalos"], $idRequisicao, $requisicao["cdFilial"], $requisicao["cdUsuario"]);
        // var_dump($retorno);
        $this->db->commit(); 
        echo "Fila cadastrada com sucesso";
        return true;
    }

    private function salvarIntervalo($intervalos, $idRequisicao, $idFilial, $idUsuario) {
        // echo $idRequisicao ." => ". $idFilial ." => ". $idUsuario ." <br/><br/>";
        // die("<pre>".var_export($intervalos, true)."</pre>");
        foreach($intervalos["intervaloPaginasDe"] as $key => $intervaloPaginaDe) {
            $sqlIntervalo = "INSERT INTO requisicao_intervalos 
                                        (id_requisicao, id_filial, id_usuario, de_pagina, ate_pagina, tipo_impressao)
                                 VALUES (:id_requisicao, :id_filial, :id_usuario, :de_pagina, :ate_pagina, :tipo_impressao)";
            $query = $this->db->prepare($sqlIntervalo);
            $parameters = array(':id_requisicao' => $idRequisicao, ':id_filial' => $idFilial, ':id_usuario' => $idUsuario,
            ':de_pagina' => $intervaloPaginaDe, ':ate_pagina' => $intervalos["intervaloPaginasaAte"][$key], ':tipo_impressao' => $intervalos["intervaloPaginasTipo"][$key]);
            $query->execute($parameters);
        }

        // var_dump($retorno);
        return true;
        
    }


}
?>
