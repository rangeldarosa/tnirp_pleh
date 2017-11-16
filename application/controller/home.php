<?php

class Home extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/HomeModel.php';
        require APP . 'model/FilaDeImpressaoModel.php';
        $this->HomeModel = new HomeModel($this->db);
        $this->filaImpressaoModel = new FilaDeImpressaoModel($this->db);
    }

    public function index() {
        Util::validarLogin();
        if($_SESSION['usuario']->nivel_de_acesso == 0) {
          header('location: '.URL.'pastas');
        }
        if($_SESSION['usuario']->nivel_de_acesso == 3) {
          $dashBoardItens = $this->HomeModel->buscarDashBoardItensAdmin();
          for ($i=0; $i <count($dashBoardItens) ; $i++) {
            $dashBoardItens[$i]['fila_atual'] = $this->filaImpressaoModel->buscarTodasAsRequisicoesPendentesPorFilial($dashBoardItens[$i]['CD_FILIAL']);
            for($j=0; $j < count($dashBoardItens[$i]['fila_atual']); $j++) {
              $dashBoardItens[$i]['fila_atual'][$j]->intervalos = $this->filaImpressaoModel->buscarIntervaloPorRequisicao($dashBoardItens[$i]['fila_atual'][$j]->CD_REQUISICAO);
            }
          }
        } else {
          $filaImpressaoItens = $this->filaImpressaoModel->buscarTodasAsRequisicoesPendentesPorFilial($_SESSION['usuario']->fk_cd_filial);
        }
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function changeStatus($cdRequisicao, $status) {
      Util::validarLogin();
      if($_SESSION['usuario']->nivel_de_acesso > 0) {
        $this->filaImpressaoModel->changeStatus($cdRequisicao, $status);
      }
      header('location: '.URL.'home');
    }

}
