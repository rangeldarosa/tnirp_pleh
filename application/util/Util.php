<?php
  Class Util{

          public static function validarLogin() {
              if(isset($_SESSION["loginEfetuado"]) && $_SESSION["loginEfetuado"] == true) {
                  return true;
              }

              header('location: ' . URL . 'login' );

          }

          public static function retornarMensagemSucesso($titulo, $causa, $mensagem){
              $_SESSION["msgSucesso"] = array();
              $_SESSION["msgSucesso"]["causa"] = $causa;
              $_SESSION["msgSucesso"]["titulo"] = $titulo;
              $_SESSION["msgSucesso"]["detalhes"] = $mensagem;
          }

          public function retornarMensagemErro($titulo, $causa, $mensagem){
              $_SESSION["msgErro"] = array();
              $_SESSION["msgErro"]["causa"] = $causa;
              $_SESSION["msgErro"]["titulo"] = $titulo;
              $_SESSION["msgErro"]["detalhes"] = $mensagem;
          }

          public static function retornarMensagemWarning($titulo, $causa, $mensagem){
              $_SESSION["msgWarning"] = array();
              $_SESSION["msgWarning"]["causa"] = $causa;
              $_SESSION["msgWarning"]["titulo"] = $titulo;
              $_SESSION["msgWarning"]["detalhes"] = $mensagem;
          }

          public static function dump($param){
              var_dump($param);
          }

          public static function validarNivelUsuario(){
              if(isset($_SESSION["usuario"]->nivel_de_acesso) && intval($_SESSION["usuario"]->nivel_de_acesso)>=1){
                  return true;
              }else{
                  self::retornarMensagemErro("ERRO!","Nível de permissão insuficiente",null);
                  header('location: ' . URL . '' );
                  die;
              }
          }

          public static function validarNivelGerente(){
              if(isset($_SESSION["usuario"]->nivel_de_acesso) && intval($_SESSION["usuario"]->nivel_de_acesso)>=2){
                  return true;
              }else{
                  self::retornarMensagemErro("ERRO!","Nível de permissão insuficiente",null);
                  header('location: ' . URL . '' );
                  die;
              }
          }

          public static function vaidarNivelAdmin(){
              if(isset($_SESSION["usuario"]->nivel_de_acesso) && intval($_SESSION["usuario"]->nivel_de_acesso)==3){
                  return true;
              }else{
                  self::retornarMensagemErro("ERRO!","Nível de permissão insuficiente",null);
                  header('location: ' . URL . '' );
                  die;
              }
          }

          public static function formatNumber($value, $casasDecimais, $prefixMilhar, $prefixCentavos) {
            return number_format($value, $casasDecimais, $prefixMilhar, $prefixCentavos);
          }

          public static function formatCashCurrent($value) {
            return VALOR_PREFIX_MOEDA.' '.Util::formatNumber($value, VALOR_CASAS_DECIMAIS, VALOR_PREFIX_CENTAVOS, VALOR_PREFIX_MILHAR);
          }

          public static function recuperarPaginaDoPDFEmBase64($nomeDocumento, $pagina) {

            $dir = dirname(__FILE__); 
            $dir = str_replace("application\controller","", $dir);
            $dir = str_replace("application/controller","", $dir);
            $dir .= "documentos/";
    
            // exec("convert -alpha off input.pdf -resize 500x700! -background white -flatten -quality 90 output.jpg");
    
            $comando = "convert -alpha off -density 288 ". $dir . $nomeDocumento .".pdf[". $pagina ."] -resize 1000x1000 -background white -flatten -quality 90 ". $dir ."imagem_convertida.jpg";
            exec($comando);
            
            $comando = "composite -dissolve 90% -gravity center ". $dir ."copyright.png ". $dir ."imagem_convertida.jpg ". $dir ."imagem_convertida.jpg";
            exec($comando);
    
            
            $path = $dir ."imagem_convertida.jpg";
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;

          }

  }
?>
