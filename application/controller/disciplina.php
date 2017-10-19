<?php

class Disciplina extends Controller {

    function __construct()  {
        
        parent::__construct();
        require APP . 'model/DisciplinaModel.php';
        require APP . 'util/Util.php';
        $this->model = new DisciplinaModel($this->db);
     }

     public function index() {
                
        Util::validarLogin();
        
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $professor = $this->model->listarDisciplina($id);
        }
        
        $disciplinas = $this->model->buscarTodasDisciplinas();
        require APP . 'view/_templates/header.php';
        require APP . 'view/disciplina/index.php';
        require APP . 'view/_templates/footer.php';
    }
}