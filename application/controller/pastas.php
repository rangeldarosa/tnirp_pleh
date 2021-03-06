<?php

class Pastas extends Controller {

    function __construct()  {

        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/InstituicaoModel.php';
        require APP . 'model/FilialModel.php';
        require APP . 'model/AnoModel.php';
        require APP . 'model/CursoModel.php';
        require APP . 'model/ProfessorModel.php';
        require APP . 'model/DisciplinaModel.php';
        require APP . 'model/ArquivoModel.php';
        require APP . 'model/FilaDeImpressaoModel.php';
        $this->instituicaoModel = new InstituicaoModel($this->db);
        $this->filialModel = new FilialModel($this->db);
        $this->anoModel = new AnoModel($this->db);
        $this->cursoModel = new CursoModel($this->db);
        $this->professorModel = new ProfessorModel($this->db);
        $this->disciplinaModel = new DisciplinaModel($this->db);
        $this->arquivoModel = new ArquivoModel($this->db);
        $this->filaDeImpressaoModel = new FilaDeImpressaoModel($this->db);
    }

    public function index() {
        Util::validarLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/pastas/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function buscaPastasByPages($modo, $page, $idInstituicao, $idFilial, $idAno, $idCurso, $idProfessor, $idDisciplina, $idArquivo) {
        Util::validarLogin();
        $navTopAtual = array();
        $showNavTop = false;
        if($idInstituicao !== 'null') {
          $idInstituicaoView = $idInstituicao;
          $navTopAtual[0] = array();
          $navTopAtual[0]['active'] = false;
        }
        if($idFilial !== 'null') {
          $idFilialView = $idFilial;
          $navTopAtual[1] = array();
          $navTopAtual[1]['active'] = false;
        }
        if($idAno !== 'null') {
          $idAnoView = $idAno;
          $navTopAtual[2] = array();;
          $navTopAtual[2]['active'] = false;
        }
        if($idCurso !== 'null') {
          $idCursoView = $idCurso;
          $navTopAtual[3] = array();
          $navTopAtual[3]['active'] = false;
        }
        if($idProfessor !== 'null') {
          $idProfessorView = $idProfessor;
          $navTopAtual[4] = array();
          $navTopAtual[4]['active'] = false;
        }
        if($idDisciplina !== 'null') {
          $idDisciplinaView = $idDisciplina;
          $navTopAtual[5] = array();
          $navTopAtual[5]['active'] = false;
        }
        if($idArquivo !== 'null') {
          $idArquivoView = $idArquivo;
          $navTopAtual[6] = array();
          $navTopAtual[6]['active'] = false;
        }

        if($modo == 'find') {
          $modelTitle = 'Resultado da Busca';
          var_dump($_POST['searchValue']);
        }

        if($modo == 'instituicao') {
          $modelTitle = 'Selecione sua Instituição';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $nextType = 'filial';
          $styleTypeName = 'font-size: 14px;font-weight:bold;';
          $listas = $this->instituicaoModel->findInstituicoesWhileHaveFilial();
        }
        if($modo == 'filial') {
          $modelTitle = 'Selecione a Filial';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'instituicao/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'ano';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->filialModel->buscarFilialPorInsituicaoAtivo((int)$idInstituicao);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] =  "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[0]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'ano') {
          $modelTitle = 'Selecione o Ano';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'curso';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int) $idFilial, (int)$idInstituicao);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] =  "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['nome'] = $listas[0]->NOME_FILIAL;
            $navTopAtual[1]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'curso') {
          $modelTitle = 'Selecione o Curso';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'professor';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->cursoModel->buscarCursoPorAnoFilialInstituicaoAtivo((int)$idInstituicao, (int) $idFilial, (int) $idAno);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] =  "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['nome'] = $listas[0]->NOME_FILIAL;
            $navTopAtual[1]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[2]['nome'] = $listas[0]->NOME_ANO;
            $navTopAtual[2]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[2]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'professor') {
          $modelTitle = 'Selecione o Professor';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'disciplina';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->professorModel->buscarProfessorPorCursoAnoFilialInstituicaoAtivos((int)$idInstituicao, (int) $idFilial, (int) $idAno, (int) $idCurso);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['nome'] = $listas[0]->NOME_FILIAL;
            $navTopAtual[1]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[2]['nome'] = $listas[0]->NOME_ANO;
            $navTopAtual[2]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[3]['nome'] = $listas[0]->NOME_CURSO;
            $navTopAtual[3]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'professor/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[3]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'disciplina') {
          $modelTitle = 'Selecione a Disciplina';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'professor/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'arquivo';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->disciplinaModel->buscarDisciplinaPorProfessorCursoAnoFilialInstituicaoAtivos((int)$idProfessor, (int)$idInstituicao, (int) $idFilial, (int) $idAno, (int) $idCurso);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['nome'] = $listas[0]->NOME_FILIAL;
            $navTopAtual[1]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[2]['nome'] = $listas[0]->NOME_ANO;
            $navTopAtual[2]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[3]['nome'] = $listas[0]->NOME_CURSO;
            $navTopAtual[3]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'professor/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[4]['nome'] = $listas[0]->NOME_PROFESSOR;
            $navTopAtual[4]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'disciplina/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[4]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'arquivo') {
          $modelTitle = 'Selecione o Documento';
          $gridType = 'col-lg-2 col-sm-3 col-md-4 col-xs-12';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'disciplina/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'openFile';
          $styleTypeName = 'font-size: 16px;font-weight:bold;line-height:1;';
          $styleTypeSubName = 'font-size: 13px;color:#F00;line-height:1;';
          $stylePriceColorido = 'font-size: 14px;color: #F00;margin-top:5px;line-height:2;';
          $stylePricePB = 'font-size: 14px;color: #000;';
          $styleValorVariacao = 'font-size: 11px;color: #777;font-weight:bold;position: relative;width: 100%;bottom: -10px;';
          $listas = $this->arquivoModel->buscarArquivosPorDisciplinaProfessorCursoAnoFilialInstituicaoAtivos((int)$idDisciplina, (int)$idProfessor, (int) $idInstituicao, (int) $idFilial, (int) $idAno, (int) $idCurso);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['nome'] = $listas[0]->NOME_FILIAL;
            $navTopAtual[1]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[2]['nome'] = $listas[0]->NOME_ANO;
            $navTopAtual[2]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[3]['nome'] = $listas[0]->NOME_CURSO;
            $navTopAtual[3]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'professor/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[4]['nome'] = $listas[0]->NOME_PROFESSOR;
            $navTopAtual[4]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'disciplina/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[5]['nome'] = $listas[0]->NOME_DISCIPLINA;
            $navTopAtual[5]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'arquivo/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[5]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'openFile') {
          $modelTitle = 'Preencha as Opções';
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'arquivo/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'print';
          $base64 = Util::recuperarPaginaDoPDFEmBase64('arquivo', 6);
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->arquivoModel->findFileForPrint((int)$idDisciplina, (int)$idProfessor, (int) $idInstituicao, (int) $idFilial, (int) $idAno, (int) $idCurso, (int) $idArquivo);
          if(isset($listas) && is_array($listas) && !empty($listas)) {
            $navTopAtual[0]['nome'] = $listas[0]->NOME_INSTITUICAO;
            $navTopAtual[0]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'filial/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[1]['nome'] = $listas[0]->NOME_FILIAL;
            $navTopAtual[1]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'ano/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[2]['nome'] = $listas[0]->NOME_ANO;
            $navTopAtual[2]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'curso/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[3]['nome'] = $listas[0]->NOME_CURSO;
            $navTopAtual[3]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'professor/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[4]['nome'] = $listas[0]->NOME_PROFESSOR;
            $navTopAtual[4]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'disciplina/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[5]['nome'] = $listas[0]->NOME_DISCIPLINA;
            $navTopAtual[5]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'arquivo/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[6]['nome'] = $listas[0]->NOME;
            $navTopAtual[6]['link'] = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'arquivo/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
            $navTopAtual[6]['active'] = true;
            $showNavTop = true;
          }
        }
        if($modo == 'print') {
          $backMethod = 'buscaPastasByPages';
          $nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'openFile/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          $nextType = 'addPrintFile';
          $styleTypeName = 'font-size: 12px;font-weight:bold;';
          $styleTypeSubName = 'font-size: 10px;color:#777;';
          $listas = $this->anoModel->buscarAnoPorFilialEInstituicaoComboAtivo((int)$idInstituicao, (int) $idFilial);
        }
        if($modo == 'addPrintFile') {
          //$backMethod = 'buscaPastasByPages';
          //$nextMethod = 'buscaPastasByPages';
          $backMode = "appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'print/1/".$idInstituicao."/".$idFilial."/".$idAno."/".$idCurso."/".$idProfessor."/".$idDisciplina."/".$idArquivo."')";
          //$nextType = null;
          //$styleTypeName = 'font-size: 12px;font-weight:bold;';
          //$styleTypeSubName = 'font-size: 10px;color:#777;';
          // INSERT FILA DE IMPRESSÃO
        }

        if ($idArquivo != null && $idArquivo != "null") {
          $locationFile = $this->arquivoModel->buscarCaminhoArquivo(intval($idArquivo));
          $nomeDocumento = $locationFile->CAMINHO;
          $intervaloPaginas = Util::sugerirIntervalosDocumento($nomeDocumento);
          if (!$intervaloPaginas) {
            $intervaloPaginas = Array();
            $intervaloPaginas["intervaloPaginasaDe"] = array(1);
            $intervaloPaginas["intervaloPaginasaAte"] = Array($listas[0]->PAGINAS);
            $intervaloPaginas["intervaloPaginasTipo"] = Array('PRETO_BRANCO');
          }
        }

        require APP . 'view/pastas/loadPastasAjax.php';
    }

    public function loadImageFile($page, $cdArquivo) {
      $locationFile = $this->arquivoModel->buscarCaminhoArquivo(intval($cdArquivo));
      $base64 = Util::recuperarPaginaDoPDFEmBase64($locationFile->CAMINHO, intval($page-1));
      require APP . 'view/pastas/loadImageAjax.php';
    }

    public function adicionarAFila() {
      // die("<pre>".var_export($_POST, true)."</pre>");

      $requisicao = Array();
      $requisicao["cdUsuario"] = $_SESSION["usuario"]->cd_usuario;
      $requisicao["cdFilial"] = $_SESSION['usuario']->fk_cd_filial;
      $requisicao["cdArquivo"] = $_POST["CD_ARQUIVO"];
      $requisicao["nomeUsuario"] = $_POST["nomeAlunoFila"];

      $requisicao["intervalos"] = Array();
      $requisicao["intervalos"]["intervaloPaginasDe"] = $_POST["intervaloPaginasDe"];
      $requisicao["intervalos"]["intervaloPaginasaAte"] = $_POST["intervaloPaginasaAte"];
      $requisicao["intervalos"]["intervaloPaginasTipo"] = $_POST["intervaloPaginasTipo"];

      $this->filaDeImpressaoModel->salvarRequisicao($requisicao);

      // $nomeArquivo = $_POST["NMARQUIVO"];



    }

}
