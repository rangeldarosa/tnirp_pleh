<?php

class Login extends Controller {

  function __construct()  {

      parent::__construct();
      require APP . 'model/loginModel.php';
      require APP . 'util/Util.php';

      $this->model = new LoginModel($this->db);
  }

  public function index() {
    require APP . 'view/login/index.php';
  }

  public function validarLogin() {
      if(!empty($_POST['login']) && !empty($_POST['senha'])) {
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        $usuario = $this->model->validarLogin($login, $senha);
        if(isset($usuario->login) && isset($usuario->senha) && $usuario->login == $login  && $usuario->senha == $senha) {
            $_SESSION["usuario"] = $usuario;
            $_SESSION["loginEfetuado"] = true;
            if($_SESSION["usuario"]->nivel_de_acesso == 0) {
              header('location: '.URL.'pastas');
            } else {
              header('location: '.URL);
            }
        } else {
            Util::retornarMensagemErro("Erro ao Efetuar Login", "Login ou Senha Inválidos", "Usuário não encontrado na base de dados");
            header('location: '.URL);
        }
      } else {
        Util::retornarMensagemErro("Erro ao Efetuar Login", "Campo Login ou Senha Vazio", "Preencha todos os campos");
        header('location: '.URL);
      }
  }

  public function logout() {
        unset($_SESSION["usuario"]);
        unset($_SESSION["loginEfetuado"]);
        header('location: '.URL);
  }

}
