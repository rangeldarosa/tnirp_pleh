<?php
    class Filial extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/FilialModel.php';
            require APP . 'util/Util.php';
            $this->model = new FilialModel($this->db);
        }


        public function index()
        {
            Util::validarLogin();

            $filiais = $this->model->buscarTodosAsFiliais();

            require APP . 'view/_templates/header.php';
            require APP . 'view/filial/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function listarFiliais()
        {
            $filiais = $this->model->buscarTodosAsFiliais();

            require APP . 'view/_templates/header.php';
            require APP . 'view/filial/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarFilial()
        {
            $filial = array();
            if(isset($_POST["cadFilialNome"]) && isset($_POST["cadFilialTaxaImpressaoColorida"])
            && isset($_POST["cadFilialTaxaImpressaoPretoEBranco"]) && isset($_POST["cadFilialCidade"])
            && isset($_POST["cadFilialInstituicao"]) && isset($_POST["cadFilialEstado"])) {// esse estado referência ao estado de ativo e inativo
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
            }
        }

        public function verificaBloquearOuDesbloquear($cdFilial)
        {
            $filial = $this->model->buscarFilialPorCd($cdFilial);
            if($filial->ESTADO === '0' ){
                $this->model->desbloquearFilial($cdFilial);
            }else{
                $this->model->bloquearFilial($cdFilial);
            }
        }


        public function editarFilial($cdFilial)
        {
          $filiais = $this->model->buscarTodosAsFiliais();
          $filial = $this->model->buscarFilialPorCd($cdFilial);

          require APP . 'view/_templates/header.php';
          require APP . 'view/filial/index.php';
          require APP . 'view/_templates/footer.php';

          if($cdFilial && isset($_POST)) {
            $filialEdit = array();
            if(isset($_POST["cadFilialNome"]) && isset($_POST["cadFilialTaxaImpressaoColorida"])
            && isset($_POST["cadFilialTaxaImpressaoPretoEBranco"]) && isset($_POST["cadFilialCidade"])
            && isset($_POST["cadFilialInstituicao"]) && isset($_POST["cadFilialEstado"])) {
                $filialEdit["nome"] = $_POST["cadFilialNome"];
                $filialEdit["impc"] = $_POST["cadFilialTaxaImpressaoColorida"];
                $filialEdit["imppb"] = $_POST["cadFilialTaxaImpressaoPretoEBranco"];
                $filialEdit["cidade"] =   $_POST["cadFilialCidade"];
                $filialEdit["instituicao"] = $_POST["cadFilialInstituicao"];
                $filialEdit["status"] = $_POST["cadFilialEstado"];
              if($this->model->editarFilial($filialEdit, $cdFilial)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Filial, Alterada com sucesso");
                header('location: ' . URL . 'filial/');
              } else {
                Util::retornarMensagemErro("Erro ao Editar Filial", "ERRO NO UPDATE", "Algo de Errado ao Atualizar Filial");
              }
            } else {
              Util::retornarMensagemErro("Erro ao Editar Filial", "Campos Vazio", "Preencha todos os campos");
            }
          }
        }


    }
?>
