<?php
    class Filial extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/FilialModel.php';
            require APP . 'util/Util.php';
            $this->model = new FilialModel($this->db);
        }
        
        
        public function index() {
            Util::validarLogin();


            require APP . 'view/_templates/header.php';
            require APP . 'view/filial/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarFilial() {
            $filial = array();
            if(isset($_POST["cadFilialNome"]) && isset($_POST["cadFilialTaxaImpressaoColorida"]) 
            && isset($_POST["cadFilialTaxaImpressaoPretoEBranco"]) && isset($_POST["cadFilialCidade"]) 
            && isset($_POST["cadFilialInstituicao"]) && isset($_POST["cadFilialEstado"])) {// esse estado referência ao estado de ativo e inativo
                $filial["nome"] = $_POST["cadFilialNome"];
                $filial["impc"] = $_POST["cadFilialTaxaImpressaoColorida"];
                $filial["imppb"] = ["cadFilialTaxaImpressaoPretoEBranco"];
                $filial["cidade"] =   $_POST["cadFilialCidade"];
                $filial["instituicao"] = $_POST["cadFilialInstituicao"];
                $filial["status"] = $_POST["cadFilialEstado"];
                if($this->model->salvarFilial($filial)) {
                    header('location: ' . URL . 'filial/');
                }
            }
        }
    }    
?>