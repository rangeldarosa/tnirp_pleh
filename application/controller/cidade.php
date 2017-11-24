<?php
    class Cidade extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/CidadeModel.php';
            require APP . 'util/Util.php';
            $this->model = new CidadeModel($this->db);
        }


        public function index()
        {
            Util::validarLogin();
            Util::validarNivelGerente();
            $cidades = $this->model->buscarTodasAsCidades();

            require APP . 'view/_templates/header.php';
            require APP . 'view/cidade/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarCidade()
        {
            $cidade = array();
            if(isset($_POST["cadCidadeNome"]) && isset($_POST["cadCidadeEstado"])) {
              $cidade["nome"] = $_POST["cadCidadeNome"];
              $cidade["estado"] = $_POST["cadCidadeEstado"];
              if($this->model->salvarCidade($cidade)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Cidade cadastrada com sucesso");
                header('location: ' . URL . 'cidade/');
              }
            }
        }
        public function listarCidades()
        {
            $cidades = $this->model->buscarTodasAsCidades();

            require APP . 'view/_templates/header.php';
            require APP . 'view/cidade/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function editarCidade($cdCidade){
          $cidades = $this->model->buscarTodasAsCidades();
          $cidade = $this->model->buscarCidadePor($cdCidade);

          require APP . 'view/_templates/header.php';
          require APP . 'view/cidade/index.php';
          require APP . 'view/_templates/footer.php';

          if($cdCidade && isset($_POST))  {
              if(!empty($_POST["cadCidadeNome"]) && !empty($_POST["cadCidadeEstado"])) {
                $cidadeEdit = array();
                $cidadeEdit["codigo"] = $cdCidade;
                $cidadeEdit["nome"] = $_POST["cadCidadeNome"];
                $cidadeEdit["estado"] = $_POST["cadCidadeEstado"];

                if($this->model->editarCidade($cidadeEdit)) {
                  Util::retornarMensagemSucesso("Sucesso", null, "Cidade alterada com sucesso");
                  header('location: ' . URL . 'cidade/');
                }
              }
          }
        }
    }
?>
