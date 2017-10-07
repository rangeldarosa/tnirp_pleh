<?php

Class Util{
    static function validarLogin() {

            session_start();

            $loginEfetuado = $_SESSION["loginEfetuado"];

            if($loginEfetuado) {
                return true;
            }

            header('location: ' . URL . '/login' );

        }

        static function retornarMensagemSucesso($mensagem){
            $_SESSION["msgSucesso"] = $mensagem;
        }

        static function retornarMensagemErro($mensagem){
            $_SESSION["msgErro"] = $mensagem;
        }

        static function retornarMensagemWarning($mensagem){
            $_SESSION["msgWarning"] = $mensagem;
        }

        static function dump($param){
            var_dump($param);
        }
}
?>
