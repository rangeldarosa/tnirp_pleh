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
                Util::retornarMensagemSucesso("Sucesso", null, "Usuário cadastrado com sucesso");
                header('location: ' . URL . 'usuario/');
              }
            }
        }

        public function editarUsuario($idUsuario){

          $filiais = $this->filialModel->buscarTodosAsFiliais();
          $usuarios = $this->model->buscarTodososUsuarios();
          $usuario = $this->model->buscarUsuarioPorCd($idUsuario);

          require APP . 'view/_templates/header.php';
          require APP . 'view/usuario/index.php';
          require APP . 'view/_templates/footer.php';

          if($idUsuario && isset($_POST))  {
            if(isset($_POST["cadUsuarioLogin"]) && isset($_POST["cadUsuarioSenha"]) && isset($_POST["cadUsuarioNivelAcesso"]) && isset($_POST['cadUsuarioFilial'])) {
              $usuario = array();
              $usuario["login"] = $_POST["cadUsuarioLogin"];
              $usuario["senha"] = $_POST["cadUsuarioSenha"];
              $usuario["nivel_de_acesso"] = $_POST["cadUsuarioNivelAcesso"];
              $usuario["cadUsuarioFilial"] = $_POST["cadUsuarioFilial"];
              $usuario["estado"] = 1;
              if($this->model->editarUsuario($usuario,$idUsuario)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Usuário alterado com sucesso");
                header('location: ' . URL . 'usuario/');
              }
            }
          }


        }

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
