<?php
    class Instituicao extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/InstituicaoModel.php';
            require APP . 'util/Util.php';
            $this->model = new InstituicaoModel($this->db);
        }


        public function index()
        {
            Util::validarLogin();

            $instituicoes = $this->model->buscarTodosAsInstituicoes();
            require APP . 'view/_templates/header.php';
            require APP . 'view/instituicao/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarInstituicao()
        {
            $instituicao = array();
            if(isset($_POST["cadInstituicaoNome"])) {
              $instituicao["nome"] = $_POST["cadInstituicaoNome"];
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
    }
?>
