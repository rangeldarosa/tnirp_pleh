<?php

class carregaComboFilialByInstituicao extends Controller {

    function __construct()  {

        parent::__construct();
        require APP . 'model/FilialModel.php';
        require APP . 'util/Util.php';
        $this->model = new FilialModel($this->db);
     }

     public function index() {
        Util::validarLogin();
        Util::validarNivelGerente();
        die("PARAMETRO É ESPERADO");
    }



}
