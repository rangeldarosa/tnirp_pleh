<?php

class Documentos extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/HomeModel.php';
        require APP . 'model/FilaDeImpressaoModel.php';
        $this->HomeModel = new HomeModel($this->db);
        $this->filaImpressaoModel = new FilaDeImpressaoModel($this->db);
    }

    public function index() {
      Util::validarLogin();
      Util::validarNivelGerente();
    }

    public function getFile($folderInical, $ano, $curso, $disciplina, $professor, $file) {
      Util::validarLogin();
      Util::validarNivelGerente();
      $dirAtual = dirname(__FILE__);
      $dirAtual = str_replace("application\controller","", $dirAtual);
      $dirAtual = str_replace("application/controller","", $dirAtual);

      $fileLink = $dirAtual.$folderInical."\\".$ano."\\".$curso."\\".$disciplina."\\".$professor."\\".$file;
      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="' . $file . '"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($fileLink));
      header('Accept-Ranges: bytes');
      @readfile($fileLink);
    }

}
