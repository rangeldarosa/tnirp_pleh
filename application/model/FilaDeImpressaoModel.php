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
        $sql = "INSERT INTO requisicao (FK_CD_USUARIO, FK_USUARIO_CD_FILIAL, FK_CD_ARQUIVO, DATA, TIPO) values (:cdUsuario, :cdFilial, :cdArquivo, :data, :tipo)";
        $query = $this->db->prepare($sql);
        $parameters = array(':FK_CD_USUARIO' => $requisicao["cdUsuario"], ':FK_USUARIO_CD_FILIAL' => $requisicao["cdfilial"], ':FK_CD_ARQUIVO' => $requisicao["cdArquivo"],
        ':data' => $requisicao["data"], ':tipo' => $requisicao["tipo"]);
        $retorno = $query->execute($parameters);
        var_dump($retorno);
        return true;
    }
}
?>
