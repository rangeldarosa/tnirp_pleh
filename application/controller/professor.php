<?php

/**
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Professor extends Controller
{

    function __construct()  {
        
        parent::__construct();
        require APP . 'model/ProfessorModel.php';
        require APP . 'util/Util.php';
        // create new "model" (and pass the database connection)
        $this->model = new ProfessorModel($this->db);
    }
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        validarLogin();
        
        $professores = $this->model->buscarTodosProfessores();
        //log($professores);
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function salvarProfessor() {

        $professor = array();

        $professor["nome"] = $_POST["nome"];
        $professor["email"] = $_POST["email"];
        $professor["acessoPublico"] = $_POST["acessoPublico"];

        // realizar validações de entrada dos dados, como campos obrigatórios

        $this->model->salvarProfessor($professor);

    }

    public function listarProfessores() {

        validarLogin();

        $professores = $this->model->buscarTodosProfessores();

        // var_dump($professores);

        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';

    }
    
}
