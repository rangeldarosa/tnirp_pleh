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

          public static function recuperarPaginaDoPDFEmBase64($documento, $pagina) {
            $dir = dirname(__FILE__);
            $dir = str_replace("application\util","", $dir);
            $dir = str_replace("application/util","", $dir);
            $dir .= "documentos/";
			      $documento = $dir.$documento;

            $nomeArquivo = $_SESSION["usuario"]->cd_usuario . "img.jpg";
            $comando = "convert -alpha off -density 288 ". $documento ."[". $pagina ."] -resize 1000x1000 -background white -flatten -quality 90 ". $dir . $nomeArquivo;
            exec($comando);

            $comando = "composite -dissolve 30% -gravity center -resize 1000x1000 ". $dir ."copyright.png ". $dir . $nomeArquivo ." ". $dir . $nomeArquivo;
            exec($comando);


            $path = $dir . $nomeArquivo;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            @$data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;

          }

          public static function sugerirIntervalosDocumento($nomeArquivo) {

            $numPaginas = Util::numeroPaginas($nomeArquivo);
            if ($numPaginas === 0) {
                return null;
            }
            $intervaloColorido = null;

            $intervalos = Array();
            $intervalos["intervaloPaginasaDe"] = Array();
            $intervalos["intervaloPaginasaAte"] = Array();
            $intervalos["intervaloPaginasTipo"] = Array();
            for ($i=0; $i < $numPaginas; $i++) {

                $colorida = Util::verificarSePaginaEColorida($nomeArquivo, $i);
                if ($intervaloColorido === null || boolval($colorida) !== boolval($intervaloColorido)) {
                    if ($intervaloColorido != null && $i > 0) {
                        $intervalos["intervaloPaginasaAte"][] = $i;
                    }
                    $intervalos["intervaloPaginasaDe"][] = $i + 1;
                    if ($colorida) {
                        $intervalos["intervaloPaginasTipo"][] = "COLORIDO";
                        $intervaloColorido = true;
                    } else {
                        $intervalos["intervaloPaginasTipo"][] = "PRETO_BRANCO";
                        $intervaloColorido = false;
                    }
                }

            }

            $intervalos["intervaloPaginasaAte"][] = $i;
            return $intervalos;

        }

        public static function numeroPaginas($nomeDocumento) {

            $dir = dirname(__FILE__);

            $dir = str_replace("application\util","", $dir);
            $dir = str_replace("application/util","", $dir);
            $dir .= "documentos/";
            $documento = $dir.$nomeDocumento;

            $comando = "identify ". $documento;
            $identify = exec($comando , $output);
            return count($output);

        }

        public static function verificarSePaginaEColorida($nomeDocumento, $pagina) {

            $dir = dirname(__FILE__);
            $dir = str_replace("application\controller","", $dir);
            $dir = str_replace("application/controller","", $dir);

            $dir = str_replace("application\util","", $dir);
            $dir = str_replace("application/util","", $dir);
            $dir .= "documentos/";
            $documento = $dir.$nomeDocumento;

            $comando = "convert ". $documento ."[". $pagina ."] -colorspace HSL -channel G -separate -format %[fx:mean] info:";
            $convert = exec($comando , $output);
            return floatval($output[0]) > 0;

        }

  }
?>
