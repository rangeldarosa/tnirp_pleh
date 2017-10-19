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
                Util::retornarMensagemSucesso("Sucesso", null, "Cidade, inserida com sucesso");
                header('location: ' . URL . 'cidade/');
              }
            }
        }
        public function listarCidades()
        {
            $professores = $this->model->buscarTodasAsCidades();

            require APP . 'view/_templates/header.php';
            require APP . 'view/cidade/index.php';
            require APP . 'view/_templates/footer.php';
        }
    }
?>
