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
        
        static function retornaMensagemErro($mensagem){
            $_SESSION["msgErro"] = $mensagem;
        }
        
        static function dump($param){
            var_dump($param);
        }
}
?>