<?php 

function validarLogin() {

    session_start();

    $loginEfetuado = $_SESSION["loginEfetuado"];

    if($loginEfetuado) {
        return true;
    }

    header('location: ' . URL . '/login' );

}

function dump($param){
    var_dump($param);
}

?>