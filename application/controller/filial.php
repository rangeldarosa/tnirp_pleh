<?php
    class Filial extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/FilialModel.php';
            require APP . 'model/CidadeModel.php';
            require APP . 'model/InstituicaoModel.php';
            require APP . 'model/AuxiliarFilialAnoModel.php'
            require APP . 'util/Util.php';
            $this->model = new FilialModel($this->db);
            $this->cidadeModel = new CidadeModel($this->db);
            $this->instituicaoModel = new InstituicaoModel($this->db);
        }


        public function index()
        {
            Util::validarLogin();
            Util::validarNivelGerente();

            $filiais = $this->model->buscarTodosAsFiliais();
            $cidades = $this->cidadeModel->buscarTodasAsCidades();
            $instituicoes = $this->instituicaoModel->buscarTodosAsInstituicoes();

            require APP . 'view/_templates/header.php';
            require APP . 'view/filial/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function listarFiliais()
        {
            $filiais = $this->model->buscarTodosAsFiliais();
            $cidades = $this->cidadeModel->buscarTodasAsCidades();
            $instituicoes = $this->instituicaoModel->buscarTodosAsInstituicoes();

            require APP . 'view/_templates/header.php';
            require APP . 'view/filial/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function listarCidades(){
            $cidades = $this->cidadeModel->buscarTodasAsCidades();
        }

        public function listarInstituicoes(){
            $instituicoes = $this->instituicaoModel->buscarTodosAsInstituicoes();
        }

        public function salvarFilial() {
            $filial = array();
            if(isset($_POST["cadFilialNome"]) && isset($_POST["cadFilialTaxaImpressaoColorida"])
            && isset($_POST["cadFilialTaxaImpressaoPretoEBranco"]) && isset($_POST["cadFilialCidade"])
            && isset($_POST["cadFilialInstituicao"]) && isset($_POST["cadFilialEstado"])) {
                $filial["nome"] = $_POST["cadFilialNome"];
                $filial["impc"] = $_POST["cadFilialTaxaImpressaoColorida"];
                $filial["imppb"] = $_POST["cadFilialTaxaImpressaoPretoEBranco"];
                $filial["cidade"] =   $_POST["cadFilialCidade"];
                $filial["instituicao"] = $_POST["cadFilialInstituicao"];
                $filial["status"] = $_POST["cadFilialEstado"];
                if($this->model->salvarFilial($filial)) {
                    Util::retornarMensagemSucesso("Sucesso", null, "Filial, inserida com sucesso");
                    header('location: ' . URL . 'filial/');

                }
            } else{
                Util::retornarMensagemErro("Erro ao Cadastrar Filial", "Campos Vazio", "Preencha todos os campos");
                header('location: ' . URL . 'filial/');
            }
        }

        public function desbloquearFilial($cdFilial){
            $this->model->desbloquearFilial($cdFilial);
        }

        public function bloquearFilial($cdFilial){
            $this->model->bloquearFilial($cdFilial);
        }

        public function editarFilial($cdFilial)
        {
          $filiais = $this->model->buscarTodosAsFiliais();
          $filial = $this->model->buscarFilialPorCd($cdFilial);
          $cidades = $this->cidadeModel->buscarTodasAsCidades();
          $instituicoes = $this->instituicaoModel->buscarTodosAsInstituicoes();
          $listaAnos = $this->modelAuxFilialAno->listarAnosNaoRelacionados($cdFilial);
          $listaAnosRelacionados = $this->modelAuxFilialAno->listarAnosRelacionados($cdFilial);

          require APP . 'view/_templates/header.php';
          require APP . 'view/filial/index.php';
          require APP . 'view/_templates/footer.php';

          if($cdFilial && isset($_POST)) {
            $filialEdit = array();
            if(isset($_POST["cadFilialNome"]) && isset($_POST["cadFilialTaxaImpressaoColorida"])
            && isset($_POST["cadFilialTaxaImpressaoPretoEBranco"]) && isset($_POST["cadFilialCidade"])
            && isset($_POST["cadFilialInstituicao"]) && isset($_POST["cadFilialStatus"])) {
                $filialEdit["nome"] = $_POST["cadFilialNome"];
                $filialEdit["impc"] = $_POST["cadFilialTaxaImpressaoColorida"];
                $filialEdit["imppb"] = $_POST["cadFilialTaxaImpressaoPretoEBranco"];
                $filialEdit["cidade"] =   $_POST["cadFilialCidade"];
                $filialEdit["instituicao"] = $_POST["cadFilialInstituicao"];
                $filialEdit["status"] = $_POST["cadFilialStatus"];
              if($this->model->editarFilial($filialEdit, $cdFilial)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Filial, Alterada com sucesso");
                header('location: ' . URL . 'filial/');
              } else {
                Util::retornarMensagemErro("Erro ao Editar Filial", "ERRO NO UPDATE", "Algo de Errado ao Atualizar Filial");
              }
            }
          }
        }


    }
?>
