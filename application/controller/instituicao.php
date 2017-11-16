<?php
    class Instituicao extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/InstituicaoModel.php';
            require APP . 'model/FilialModel.php';
            require APP . 'util/Util.php';
            $this->model = new InstituicaoModel($this->db);
            $this->filialModel = new FilialModel($this->db);
        }


        public function index()
        {
            Util::validarLogin();
            Util::validarNivelGerente();

            $instituicoes = $this->model->buscarTodosAsInstituicoes();
            $listaFilial = $this->filialModel->buscarTodosAsFiliais();
            require APP . 'view/_templates/header.php';
            require APP . 'view/instituicao/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarInstituicao()
        {
            $instituicao = array();
            if(isset($_POST["cadInstituiçãoNome"])) {
              $instituicao["nome"] = $_POST["cadInstituiçãoNome"];
              if($this->model->salvarInstituicao($instituicao)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Instituicão, inserida com sucesso");
                header('location: ' . URL . 'instituicao/');
              }
            }
        }

        public function listarInstituicoes()
        {
            $instituicoes = $this->model->buscarTodosAsInstituicoes();

            require APP . 'view/_templates/header.php';
            require APP . 'view/instituicao/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function editarInstituicao($cdInstituicao)
        {
          $instituicoes = $this->model->buscarTodosAsInstituicoes();
          $instituicao = $this->model->buscarInstituicaoPorCd($cdInstituicao);

          require APP . 'view/_templates/header.php';
          require APP . 'view/instituicao/index.php';
          require APP . 'view/_templates/footer.php';

          if($cdInstituicao && isset($_POST))  {
            $instituicaoEdit = array();
            if(!empty($_POST["cadInstituiçãoNome"])) {
              $instituicaoEdit["nome"] = $_POST["cadInstituiçãoNome"];
              $instituicaoEdit["estado"] = 1;
              if($this->model->editarInstituicao($instituicaoEdit, $cdInstituicao)) {
                Util::retornarMensagemSucesso("Sucesso!", null, "Instituição, Alterado com sucesso");
                header('location: ' . URL . 'professor/');
              } else {
                Util::retornarMensagemErro("Erro ao alterar instituição!", "ERRO NO UPDATE", "Aconteceu algo errado ao atualizar o instituição");
              }
            }
          }
        }

        public function bloquearInstituicao($cdInstituicao) {
            $this->model->bloquearInstituicao($cdInstituicao);
          }

          public function desbloquearInstituicao($cdInstituicao) {
            $this->model->desbloquearInstituicao($cdInstituicao);
          }
    }
?>
