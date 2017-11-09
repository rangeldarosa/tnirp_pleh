<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Pdf extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index() {

    }

    public function exibirDocumento($nomeDocumento, $pagina) {
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

        echo "<div style='position:relative; overflow:hidden; display: inline-block; border:1px solid red; width:80%'>";
        echo "<img src='". $base64 ."' width='100%' />";
        echo "<div style='position:absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.0)'></div>";
        echo "</div>";

    }

}
