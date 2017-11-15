<?php
class HomeModel {
    function __construct($db) {
        require_once APP . 'util/Util.php';
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }

    }

    public function buscarDashBoardItensAdmin() {
        $sql = "SELECT * FROM filial WHERE filial.estado='1'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $filiais = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i<count($filiais); $i++) {
          $filiais[$i]['paginasImpressas'] = $this->buscarPaginasImpressaByFilial($filiais[$i]['CD_FILIAL']);
          $filiais[$i]['totalPbImpresso'] = 0;
          $filiais[$i]['totalColoridoImpresso'] = 0;
          $filiais[$i]['totalImpresso'] = 0;
          $filiais[$i]['ValorPbImpresso'] = 0;
          $filiais[$i]['ValorColoridoImpresso'] = 0;
          $filiais[$i]['ValorImpresso'] = 0;
          for ($j=0; $j < count($filiais[$i]['paginasImpressas']) ; $j++) {
            $inicioPagina = $filiais[$i]['paginasImpressas'][$j]['de_pagina'];
            $fimPagina = $filiais[$i]['paginasImpressas'][$j]['ate_pagina'];
            $qtPagina = ($fimPagina - $inicioPagina) + 1;
            $filiais[$i]['totalImpresso'] += $qtPagina;
            if($filiais[$i]['paginasImpressas'][$j]['tipo_impressao'] == 'PRETO_BRANCO') {
              $filiais[$i]['ValorPbImpresso'] = $qtPagina * $filiais[$i]['TAXA_IMPRESSAO_PRETO_E_BRANCO'];
              $filiais[$i]['totalPbImpresso'] += $qtPagina;
            }
            if($filiais[$i]['paginasImpressas'][$j]['tipo_impressao'] == 'COLORIDO') {
              $filiais[$i]['ValorColoridoImpresso'] = $qtPagina * $filiais[$i]['TAXA_IMPRESSAO_COLORIDA'];
              $filiais[$i]['totalColoridoImpresso'] += $qtPagina;
            }
          }
        }
        return $filiais;
    }

    public function buscarDashBoardByFilial($cdFilial) {
        $sql = "SELECT * FROM filial WHERE CD_FILIAL = :cdFilial";
        $query = $this->db->prepare($sql);
        $query->execute(array(':cdFilial' => $cdFilial));
        $filiais = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i<count($filiais); $i++) {
          $filiais[$i]['paginasImpressas'] = $this->buscarPaginasImpressaByFilial($filiais[$i]['CD_FILIAL']);
          $filiais[$i]['fila_atual'] = $this->filaImpressaoModel->buscarTodasAsRequisicoesPendentesPorFilial($filiais[$i]['CD_FILIAL']);
          $filiais[$i]['totalPbImpresso'] = 0;
          $filiais[$i]['totalColoridoImpresso'] = 0;
          $filiais[$i]['totalImpresso'] = 0;
          $filiais[$i]['ValorPbImpresso'] = 0;
          $filiais[$i]['ValorColoridoImpresso'] = 0;
          $filiais[$i]['ValorImpresso'] = 0;
          for ($j=0; $j < count($filiais[$i]['paginasImpressas']) ; $j++) {
            $inicioPagina = $filiais[$i]['paginasImpressas'][$j]['de_pagina'];
            $fimPagina = $filiais[$i]['paginasImpressas'][$j]['ate_pagina'];
            $qtPagina = ($fimPagina - $inicioPagina) + 1;
            $filiais[$i]['totalImpresso'] += $qtPagina;
            if($filiais[$i]['paginasImpressas'][$j]['tipo_impressao'] == 'PRETO_BRANCO') {
              $filiais[$i]['ValorPbImpresso'] = $qtPagina * $filiais[$i]['TAXA_IMPRESSAO_PRETO_E_BRANCO'];
              $filiais[$i]['totalPbImpresso'] += $qtPagina;
            }
            if($filiais[$i]['paginasImpressas'][$j]['tipo_impressao'] == 'COLORIDO') {
              $filiais[$i]['ValorColoridoImpresso'] = $qtPagina * $filiais[$i]['TAXA_IMPRESSAO_COLORIDA'];
              $filiais[$i]['totalColoridoImpresso'] += $qtPagina;
            }
          }
        }
        return $filiais;
    }


    public function buscarPaginasImpressaByFilial($cdFilial) {
        $sql = "SELECT REQUISICAO_INTERVALOS.* FROM REQUISICAO_INTERVALOS
                JOIN REQUISICAO ON REQUISICAO.CD_REQUISICAO = REQUISICAO_INTERVALOS.ID_REQUISICAO
                AND REQUISICAO.STATUSATUAL > 0
                WHERE ID_FILIAL = :cdFilial";
        $query = $this->db->prepare($sql);
        $query->execute(array(':cdFilial' => $cdFilial));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>
