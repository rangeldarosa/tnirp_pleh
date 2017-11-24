<?php
class Professor extends Controller {

    function __construct()  {

        parent::__construct();
        require APP . 'model/ProfessorModel.php';
        require APP . 'model/AuxiliarProfessorDisciplinaModel.php';
        require APP . 'model/DisciplinaModel.php';
        require APP . 'util/Util.php';
        $this->model = new ProfessorModel($this->db);
        $this->modelAuxiliarProfessorDisciplina = new AuxiliarProfessorDisciplinaModel($this->db);
        $this->modelDisciplina = new DisciplinaModel($this->db);
    }
    public function index()
    {
        Util::validarLogin();
        Util::validarNivelGerente();

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $professor = $this->model->buscarProfessorPorCd($id);
        }

        $listaDisciplina = $this->modelDisciplina->buscarTodasDisciplinas();

        $professores = $this->model->buscarTodosProfessores();
        require APP . 'view/_templates/header.php';
        require APP . 'view/professor/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function salvarProfessor()
    {
        $professor = array();
        if(isset($_POST["cadProfessoresNome"]) && isset($_POST["cadProfessoresStatus"]) && isset($_POST["cadProfessoresPrivado"]) && isset($_POST['cadProfessorDisciplina'])) {
          
          $professor["nome"] = $_POST["cadProfessoresNome"];
          $professor["estado"] = $_POST["cadProfessoresStatus"];
          $professor["privado"] = $_POST["cadProfessoresPrivado"];
          $professor["disciplinas"] = $_POST["cadProfessorDisciplina"];

          if($this->model->salvarProfessor($professor)) {
            Util::retornarMensagemSucesso("Sucesso!", null, "Professor cadastrado com sucesso");
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

    public function bloquearProfessor($cdProfessor) {
      $this->model->bloquearProfessor($cdProfessor);
    }

    public function desbloquearProfessor($cdProfessor) {
      $this->model->desbloquearProfessor($cdProfessor);
    }



    public function editarProfessor($cdProfessor)
    {     
      
      $professores = $this->model->buscarTodosProfessores();
      $professor = $this->model->buscarProfessorPorCd($cdProfessor);

      $listaDisciplina = $this->modelAuxiliarProfessorDisciplina->listarDisciplinasNaoRelacionadas($cdProfessor);
      $listaDisciplinaRelacionada = $this->modelAuxiliarProfessorDisciplina->listarDisciplinasRelacionadas($cdProfessor);

      require APP . 'view/_templates/header.php';
      require APP . 'view/professor/index.php';
      require APP . 'view/_templates/footer.php';
      
      

      if($cdProfessor && isset($_POST))  {
        $professorEdit = array();
        if(isset($_POST["cadProfessoresNome"]) !="" && $_POST["cadProfessoresStatus"] != "" && $_POST["cadProfessoresPrivado"] != "" && is_array($_POST['cadProfessorDisciplina'])) {
          $professorEdit["nome"] = $_POST["cadProfessoresNome"];
          $professorEdit["estado"] = $_POST["cadProfessoresStatus"];
          $professorEdit["privado"] = $_POST["cadProfessoresPrivado"];
          $professorEdit["disciplinas"] = $_POST["cadProfessorDisciplina"];
          if($this->model->editarProfessor($professorEdit, $cdProfessor)) {
            Util::retornarMensagemSucesso("Sucesso!", null, "Professor alterado com sucesso");
            header('location: ' . URL . 'professor/');
          } else {
            Util::retornarMensagemErro("Erro ao alterar professor!", "ERRO NO UPDATE", "Aconteceu algo errado ao atualizar o professor");
          }
        }
      }
    }

    public function limparComboProfessorPorCurso() {
      Util::validarLogin();
      Util::validarNivelGerente();
      require APP . 'view/_templates/arquivo/ajax/carregaComboProfessorByCurso.php';
    }

    public function buscarProfessorPorCursoCombo($cdCurso, $cdInstituicao, $cdFilial, $cdAno) {
      Util::validarLogin();
      Util::validarNivelGerente();
      $listaProfessorCurso = $this->model->buscarProfessorPorCursoAnoFilialInstituicao($cdCurso, $cdInstituicao, $cdFilial, $cdAno);
      require APP . 'view/_templates/arquivo/ajax/carregaComboProfessorByCurso.php';
    }
}
