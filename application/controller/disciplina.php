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
        Util::validarNivelGerente();

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $professor = $this->model->listarDisciplina($id);
        }

        $disciplinas = $this->model->buscarTodasDisciplinas();
        require APP . 'view/_templates/header.php';
        require APP . 'view/disciplina/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function salvarDisciplina()
    {
        $disciplina = array();
        if(isset($_POST["cadDisciplinaNome"]) && isset($_POST["cadDisciplinaStatus"]) && isset($_POST["cadDisciplinaPrivada"])) {
          $disciplina["nome"] = $_POST["cadDisciplinaNome"];
          $disciplina["estado"] = $_POST["cadDisciplinaStatus"];
          $disciplina["privado"] = $_POST["cadDisciplinaPrivada"];

          if($this->model->salvarDisciplina($disciplina)) {
            Util::retornarMensagemSucesso("Sucesso!", null, "Disciplina, inserida com sucesso");
            header('location: ' . URL . 'disciplina/');
          }
        }
    }

    public function listarDisciplinas()
    {
        $disciplinas = $this->model->buscarTodasDisciplinas();

        require APP . 'view/_templates/header.php';
        require APP . 'view/disciplina/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function bloquearDisciplina($cdDisciplina) {
      $this->model->bloquearDisciplina($cdDisciplina);
    }

    public function desbloquearDisciplina($cdDisciplina) {
      $this->model->desbloquearDisciplina($cdDisciplina);
    }



    public function editarDisciplina($cdDisciplina)
    {
      $disciplinas = $this->model->buscarTodasDisciplinas();
      $disciplina = $this->model->listarDisciplina($cdDisciplina);

      require APP . 'view/_templates/header.php';
      require APP . 'view/disciplina/index.php';
      require APP . 'view/_templates/footer.php';
      
      if($cdDisciplina && isset($_POST))  {
        $disciplinaEdit = array();

        if(!empty($_POST["cadDisciplinaNome"]) && $_POST["cadDisciplinaStatus"] != "" && $_POST["cadDisciplinaPrivada"] != "") {

          $disciplinaEdit["nome"] = $_POST["cadDisciplinaNome"];
          $disciplinaEdit["estado"] = $_POST["cadDisciplinaStatus"];
          $disciplinaEdit["privado"] = $_POST["cadDisciplinaPrivada"];

          if($this->model->editarDisciplina($disciplinaEdit, $cdDisciplina)) {
            Util::retornarMensagemSucesso("Sucesso!", null, "Disciplina, Alterada com sucesso");
            header('location: ' . URL . 'disciplina/');
          } else {
            Util::retornarMensagemErro("Erro ao alterar disciplina!", "ERRO NO UPDATE", "Aconteceu algo errado ao atualizar a disciplina");
          }
        } else {
            Util::retornarMensagemErro("Erro ao alterar disciplina!", "Campos Vazio", "Preencha todos os campos");
        }
      }
    }

    public function limparComboDisciplinaPorProfessor() {
      Util::validarLogin();
      Util::validarNivelGerente();
      require APP . 'view/_templates/arquivo/ajax/carregaComboDisciplinaByProfessor.php';
    }

    public function buscarDisciplinaPorProfessorCombo($cdProfessor, $cdCurso, $cdInstituicao, $cdFilial, $cdAno) {
      Util::validarLogin();
      Util::validarNivelGerente();
      $listaDisciplinaProfessor = $this->model->buscarDisciplinaPorProfessorCursoAnoFilialInstituicao($cdProfessor, $cdCurso, $cdInstituicao, $cdFilial, $cdAno);
      require APP . 'view/_templates/arquivo/ajax/carregaComboDisciplinaByProfessor.php';
    }
}
