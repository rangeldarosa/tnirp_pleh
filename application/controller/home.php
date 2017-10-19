<?php

class Home extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
    }

    public function index() {
        Util::validarLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
