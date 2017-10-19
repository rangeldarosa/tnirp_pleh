<?php

class Problem extends Controller {

    public function index() {
        require APP . 'util/Util.php';
        Util::validarLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/problem/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
