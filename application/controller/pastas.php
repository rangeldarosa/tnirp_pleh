<?php

class Pastas extends Controller {

    function __construct()  {

        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/InstituicaoModel.php';
        require APP . 'model/FilialModel.php';
        require APP . 'model/AnoModel.php';
        require APP . 'model/CursoModel.php';
        $this->instituicaoModel = new InstituicaoModel($this->db);
        $this->filialModel = new FilialModel($this->db);
        $this->anoModel = new AnoModel($this->db);
        $this->cursoModel = new CursoModel($this->db);
    }

    public function index() {
        Util::validarLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/pastas/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function buscaPastasByPages($modo, $page, $idInstituicao, $idFilial, $idCurso, $idAno, $idProfessor, $idDisciplina, $idArquivo) {
        Util::validarLogin();
        if($modo == 'instituicao') {
          $modelTitle = 'Selecione sua Instituição';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = null;
          $nextType = 'filial';
          $styleTypeName = 'font-size: 14px;font-weight:bold;';
          $listas = $this->instituicaoModel->buscarTodosAsInstituicoesAtivas();
        }
        if($modo == 'filial') {
          $modelTitle = 'Selecione a Filial';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'instituicao/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'ano';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->filialModel->buscarFilialPorInsituicaoAtivo((int)$idInstituicao);
        }
        if($modo == 'ano') {
          $modelTitle = 'Selecione o Ano';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'curso';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'curso') {
          $modelTitle = 'Selecione o Curso';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'professor';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->cursoModel->buscarCursoPorAnoFilialInstituicaoAtivo((int)$idInstituicao, (int) $idFilial, (int) $idAno);
        }
        if($modo == 'professor') {
          $modelTitle = 'Selecione o Professor';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'disciplina';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'disciplina') {
          $modelTitle = 'Selecione a Disciplina';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'professor/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'arquivo';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'arquivo') {
          $modelTitle = 'Selecione o Documento';
          $gridType = 'col-lg-1 col-sm-3 col-md-4 col-xs-6';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'disciplina/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'openFile';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'openFile') {
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'arquivo/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'print';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'print') {
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'openFile/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'addPrintFile';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'addPrintFile') {
          //$backMethod = 'buscaPastasByPages';
          //$nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'print/1/".$idInstituicao."/".$idFilial."/".$idCurso."/".$idAno."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          //$nextType = null;
          //$styleTypeName = 'font-size: 12px;font-weight:bold;';
          //$styleTypeSubName = 'font-size: 10px;color:#777;';
          // INSERT FILA DE IMPRESSÃO
        }

        if($idInstituicao !== 'null') {
          $idInstituicaoView = $idInstituicao;
        }
        if($idFilial !== 'null') {
          $idFilialView = $idFilial;
        }
        if($idCurso !== 'null') {
          $idCursoView = $idCurso;
        }
        if($idProfessor !== 'null') {
          $idProfessorView = $idProfessor;
        }
        if($idDisciplina !== 'null') {
          $idDisciplinaView = $idDisciplina;
        }
        if($idArquivo !== 'null') {
          $idArquivoView = $idArquivo;
        }
        require APP . 'view/pastas/loadPastasAjax.php';
    }

}
