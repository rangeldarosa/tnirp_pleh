<?php

class Arquivo extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/ArquivoModel.php';
        require APP . 'model/InstituicaoModel.php';
        $this->arquivoModel = new ArquivoModel($this->db);
        $this->instituicaoModel = new InstituicaoModel($this->db);
    }

    public function index() {
        Util::validarLogin();
        $listarInstituicoesCombo = $this->instituicaoModel->buscarTodosAsInstituicoes();
        $arquivos = $this->arquivoModel->buscarTodosOsArquivos();
        for ($i=0; $i<count($arquivos); $i++) {
          $arquivos[$i]->DISCIPLINAS = $this->arquivoModel->buscarNomeDisciplinaByArquivo($arquivos[$i]->CD_ARQUIVO);
          var_dump($arquivos[$i]);
        }
        var_dump($arquivos);
        require APP . 'view/_templates/header.php';
        require APP . 'view/arquivo/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
