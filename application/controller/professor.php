<?php
class Professor extends Controller {

    function __construct()  {

        parent::__construct();
        require APP . 'model/ProfessorModel.php';
        require APP . 'util/Util.php';
        $this->model = new ProfessorModel($this->db);
    }
    public function index() 
    {
        Util::validarLogin();

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $professor = $this->model->buscarProfessorPorCd($id);
            Util::dump($professor);
        }

        $professores = $this->model->buscarTodosProfessores();
        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function salvarProfessor() 
    {

        $professor = array();
        if(isset($_POST["cadProfessoresNome"]) && isset($_POST["cadProfessoresStatus"]) && isset($_POST["cadProfessoresPrivado"])) {
          $professor["nome"] = $_POST["cadProfessoresNome"];
          $professor["estado"] = $_POST["cadProfessoresStatus"];
          $professor["privado"] = $_POST["cadProfessoresPrivado"];
          if($this->model->salvarProfessor($professor)) {
            Util::retornarMensagemSucesso("Professor, inserido com sucesso");
            header('location: ' . URL . 'professor/');
          }
        }
    }

    public function listarProfessores() 
    {
        $professores = $this->model->buscarTodosProfessores();

        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function verificaBloquearOuDesbloquear($cdProfessor)
    {
      $professor = $this->model->buscarProfessorPorCd($cdProfessor);
      if($professor->ESTADO === '0' ){
          $this->model->desbloquearProfessor($cdProfessor);
      }else{
          $this->model->bloquearProfessor($cdProfessor);
      }
  }



    public function editarProfessor($cdProfessor)
    {
      $professores = $this->model->buscarTodosProfessores();
      $professor = $this->model->buscarProfessorPorCd($cdProfessor);

      require APP . 'view/_templates/header.php';
      require APP . 'view/professor/index.php';
      require APP . 'view/_templates/footer.php';

      if($cdProfessor && isset($_POST))
      {
        $professorEdit = array();
        if(isset($_POST["cadProfessoresNome"]) && isset($_POST["cadProfessoresStatus"]) && isset( $_POST["cadProfessoresPrivado"])) {
          $professorEdit["nome"] = $_POST["cadProfessoresNome"];
          $professorEdit["estado"] = $_POST["cadProfessoresStatus"];
          $professorEdit["privado"] = $_POST["cadProfessoresPrivado"];
          if($this->model->editarProfessor($professorEdit, $cdProfessor)) {
            Util::retornarMensagemSucesso("Professor, Alterado com sucesso");
            header('location: ' . URL . 'professor/');
          } else {
            Util::retornarMensagemErro("Erro ao alterar professor");
          }
        } else {
          Util::retornarMensagemErro("Preencha todos os campos");
        }
      }
    }
}
