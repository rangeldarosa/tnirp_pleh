<?php

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

        Util::validarLogin();
        
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $professor = $this->model->buscarProfessorPorCd($id);
            Util::dump($professor);
        }

        $professores = $this->model->buscarTodosProfessores();
        //log($professores);
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';


        
    }

    public function salvarProfessor() {

        $professor = array();
        //$professor["cd_professor"] = $_POST["cadCdProfessor"] // CD PARA CASO DE ALTERAÇÃO DE UM PROFESSOR JA CADASTRADO.
        $professor["nome"] = $_POST["cadProfessoresNome"];
        $professor["estado"] = $_POST["cadProfessoresStatus"];
        $professor["privado"] = $_POST["cadProfessoresPrivado"];  

        if($professor["cd_professor"]){

        }else{
            $this->model->salvarProfessor($professor);
        }
        
        // realizar validações de entrada dos dados, como campos obrigatórios

        

    }

    public function listarProfessores() {

        Util::validarLogin();

        $professores = $this->model->buscarTodosProfessores();

        // var_dump($professores);

        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function verificaBloquearOuDesbloquear($cdProfessor){
        Util::validarLogin();

        $professor = $this->model->buscarProfessorPorCd($cdProfessor);
        if($professor->ESTADO === '0' ){
            $this->model->desbloquearProfessor($cdProfessor);
        }else{
            $this->model->bloquearProfessor($cdProfessor);
        }
    }

    public function editarProfessor($cdProfessor){ // TRAZENDO O PROFESSOR PELO ID PASSADO POR PARAMETRO, VERIFICAR COMO IRÃO TRATAR AS INFORMAÇÕES.
        Util::validarLogin();

        $professor = $this->model->buscarProfessorPorCd($cdProfessor);

        var_dump($professor);


    }

    


}
