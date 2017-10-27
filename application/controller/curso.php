<?php
    class Curso extends Controller {

        function __construct()  {
            parent::__construct();
            require APP . 'model/CursoModel.php';
            require APP . 'model/AuxiliarAnoCurso.php';
            require APP . 'util/Util.php';
            $this->model = new CursoModel($this->db);
            $this->auxiliarAnoCurso = new AuxiliarAnoCurso($this->db);
        }


        public function index(){
            Util::validarLogin();
            Util::validarNivelGerente();
            
            $cursos = $this->model->listarCursos();

            require APP . 'view/_templates/header.php';
            require APP . 'view/curso/index.php';
            require APP . 'view/_templates/footer.php';
        }

        public function salvarCurso(){
            $curso = array();

            if(isset($_POST["cadCursoNome"]) && isset($_POST["cadCursoStatus"])) {

                $curso["nome"] = $_POST["cadCursoNome"];
                $curso["estado"] = $_POST["cadCursoStatus"];
                $curso["anos"] = isset($_POST["cadAnos"]) ? $_POST["cadAnos"] : "";
                if($this->model->salvarCurso($curso)) {
                    if($curso["anos"]){
                        $cursoUltimoCadastrado = $this->model->listarUltimoCursoSalvo();
                        $curso["codigo"] = $cursoUltimoCadastrado[0]->CD_CURSO;
                        $this->auxiliarAnoCurso->salvarAuxiliarAnoCurso($curso);
                    }
                }
                Util::retornarMensagemSucesso("Sucesso", null, "Curso, inserida com sucesso");
                header('location: ' . URL . 'curso/');
            }
        }

        public function editarCurso($cdCurso){

            $cursos = $this->model->listarCursosAtivos();
            $curso = $this->model->buscarCursoPorCodigo($cdCurso);

            require APP . 'view/_templates/header.php';
            require APP . 'view/curso/index.php';
            require APP . 'view/_templates/footer.php';
            
            if($cdCurso && isset($_POST))  {

                $cursoEdit = array();
                
                if(!empty($_POST["cadCursoNome"]) && !empty($_POST["cadCursoStatus"])) {
                    $cursoEdit["codigo"] = $cdCurso;
                    $cursoEdit["nome"] = $_POST["cadCursoNome"];
                    $cursoEdit["estado"] = $_POST["cadCursoStatus"];
                    $cursoEdit["anos"] = isset($_POST["cadAnos"]) ? $_POST["cadAnos"] : "";

                    if($this->model->alterarCurso($cursoEdit, $cdCurso)) {

                        $this->auxiliarAnoCurso->deletarCursoAno($cdCurso); 
                        if($cursoEdit["anos"]){
                            $this->auxiliarAnoCurso->salvarAuxiliarAnoCurso($cursoEdit);
                        }

                        Util::retornarMensagemSucesso("Sucesso!", null, "Curso, Alterado com sucesso");
                        header('location: ' . URL . 'curso/');
                    } else {
                        Util::retornarMensagemErro("Erro ao alterar professor!", "ERRO NO UPDATE", "Aconteceu algo errado ao atualizar o professor");
                    }
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
