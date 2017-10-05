<?php

/**
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Login extends Controller
{

    function __construct()  {

        parent::__construct();
        require APP . 'model/loginModel.php';
        require APP . 'util/Util.php';
        // create new "model" (and pass the database connection)
        $this->model = new LoginModel($this->db);
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index() {
        // load views
		require APP . 'view/_templates/header.php';
        require APP . 'view/login/index.php';
		require APP . 'view/_templates/footer.php';
    }

    public function validarLogin() {

        
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        echo "Verificando acessos de ". $login;
        echo "<br>";

        $usuario = $this->model->validarLogin($login, $senha);
        dump($usuario);

        if($usuario->login == $login  && $usuario->senha == $senha) {
            echo "Usuário ". $usuario->login . ". Login efetuado com sucesso";
            session_start();
            $_SESSION["usuario"] = $usuario;
            $_SESSION["loginEfetuado"] = true;
            header('location: ' . URL . 'pastas/');
        } else {
            echo "Login ou senha incorretos";
        }

    }

    
    
}
