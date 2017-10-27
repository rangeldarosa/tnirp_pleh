<?php

class Ano extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/AnoModel.php';
        $this->model = new AnoModel($this->db);
    }

    public function index() {
        Util::validarLogin();
        Util::validarNivelGerente();

        $anos=$this->model->buscarTodosOsAnos();

        require APP . 'view/_templates/header.php';
        require APP . 'view/ano/index.php';
        require APP . 'view/_templates/footer.php';
        
    }

    public function salvarAno(){
        $ano = array();
        if(isset($_POST["cadAnoNome"]) && isset($_POST["cadAnoStatus"])) {
            $ano["nome"] = $_POST["cadAnoNome"];
            $ano["estado"] = $_POST["cadAnoStatus"];
            if($this->model->salvarAno($ano)) {
                Util::retornarMensagemSucesso("Sucesso!", null, "Ano, inserido com sucesso");
                header('location: ' . URL . 'ano/');
            }
        }
        
    }
    public function bloquearAno($cdAno) {
        $this->model->bloquearAno($cdAno);
      }
  
      public function desbloquearAno($cdAno) {
        $this->model->desbloquearAno($cdAno);
      }
    
    public function editarAno($cdAno)
    {
      $anos = $this->model->buscarTodosOsAnos();
      $ano = $this->model->buscarAnoPorCd($cdAno);

      require APP . 'view/_templates/header.php';
      require APP . 'view/ano/index.php';
      require APP . 'view/_templates/footer.php';

      if($cdAno && isset($_POST))  {
        $anoEdit = array();
        if(!empty($_POST["cadAnoNome"]) && !empty($_POST["cadAnoStatus"])) {
          $anoEdit["nome"] = $_POST["cadProfessoresNome"];
          $anoEdit["estado"] = $_POST["cadProfessoresStatus"];
          if($this->model->editarAno($anoEdit, $cdAno)) {
            Util::retornarMensagemSucesso("Sucesso!", null, "Ano, Alterado com sucesso");
            header('location: ' . URL . 'ano/');
          } else {
            Util::retornarMensagemErro("Erro ao alterar ano!", "ERRO NO UPDATE", "Aconteceu algo errado ao atualizar o ano");
          }
        }
      }
    }

}