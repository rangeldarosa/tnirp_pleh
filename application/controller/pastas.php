<?php

class Pastas extends Controller {

    function __construct()  {

        parent::__construct();
        require APP . 'util/Util.php';

    }

    public function index() {
      
        Util::validarLogin();

        require APP . 'view/_templates/header.php';
        require APP . 'view/pastas/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
