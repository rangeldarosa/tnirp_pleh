<?php
    class Curso extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/CursoModel.php';
            require APP . 'util/Util.php';
            $this->model = new CursoModel($this->db);
        }


        public function index(){
            Util::validarLogin();

            require APP . 'view/_templates/header.php';
           require APP . 'view/curso/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarCurso()
        {
            $cidade = array();
            if(isset($_POST["cadCursoNome"]) && isset($_POST["cadCursoEstado"])) {
              $curso["nome"] = $_POST["cadCursoNome"];
              $curso["estado"] = $_POST["cadCursoEstado"];
              if($this->model->salvarCurso($curso)) {
                Util::retornarMensagemSucesso("Sucesso", null, "Curso, inserida com sucesso");
                header('location: ' . URL . 'curso/');
              }
            }
        }
        
        public function listarCursos(){
            $cursos = $this->model->listarCursos();

            require APP . 'view/_templates/header.php';
            require APP . 'view/curso/index.php';
            require APP . 'view/_templates/footer.php';
        }
    }
?>
