<?php

Class Util{
    static function validarLogin() {
            if(isset($_SESSION["loginEfetuado"]) && $_SESSION["loginEfetuado"] == true) {
                return true;
            }

            header('location: ' . URL . 'login' );

        }

        static function retornarMensagemSucesso($titulo, $causa, $mensagem){
            $_SESSION["msgSucesso"] = array();
            $_SESSION["msgSucesso"]["causa"] = $causa;
            $_SESSION["msgSucesso"]["titulo"] = $titulo;
            $_SESSION["msgSucesso"]["detalhes"] = $mensagem;
        }

        static function retornarMensagemErro($titulo, $causa, $mensagem){
            $_SESSION["msgErro"] = array();
            $_SESSION["msgErro"]["causa"] = $causa;
            $_SESSION["msgErro"]["titulo"] = $titulo;
            $_SESSION["msgErro"]["detalhes"] = $mensagem;
        }

        static function retornarMensagemWarning($titulo, $causa, $mensagem){
            $_SESSION["msgWarning"] = array();
            $_SESSION["msgWarning"]["causa"] = $causa;
            $_SESSION["msgWarning"]["titulo"] = $titulo;
            $_SESSION["msgWarning"]["detalhes"] = $mensagem;
        }

        static function dump($param){
            var_dump($param);
        }
}
?>
