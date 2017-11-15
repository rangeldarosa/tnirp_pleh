<?php
    class Usuario extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/FilialModel.php';
            require APP . 'model/UsuarioModel.php';
            require APP . 'util/Util.php';
            $this->model = new UsuarioModel($this->db);
            $this->filialModel = new FilialModel($this->db);
        }


        public function index()
        {
            Util::validarLogin();
            Util::validarNivelGerente();
            $filiais = $this->filialModel->buscarTodosAsFiliais();
            $usuarios = $this->model->buscarTodososUsuarios();
            require APP . 'view/_templates/header.php';
            require APP . 'view/usuario/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarUsuario()
        {
            $usuario = array();
            if(isset($_POST["cadUsuarioLogin"]) && isset($_POST["cadUsuarioSenha"]) && isset($_POST["cadUsuarioNivelAcesso"]) && isset($_POST['cadUsuarioFilial'])) {
              $usuario["nome"] = $_POST["cadUsuarioLogin"];
              $usuario["senha"] = $_POST["cadUsuarioSenha"];
              $usuario["nivel_de_acesso"] = $_POST["cadUsuarioNivelAcesso"];
              $usuario["cadUsuarioFilial"] = $_POST["cadUsuarioFilial"];
              $usuario["estado"] = 1;
              if($this->model->salvarUsuario($usuario)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Usuario, inserida com sucesso");
                header('location: ' . URL . 'usuario/');
              }
            }
        }

        //-- FALTA EDITAR USUARIO AQUI

        public function listarUsuarios()
        {
            $instituicoes = $this->model->buscarTodosAsInstituicoes();

            require APP . 'view/_templates/header.php';
            require APP . 'view/instituicao/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function bloquearUsuario($cdUsuario) {
            $this->model->bloquearUsuario($cdUsuario);
          }

          public function desbloquearUsuario($cdUsuario) {
            $this->model->desbloquearUsuario($cdUsuario);
          }

    }
?>
