<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
<head>
    <meta charset="utf-8">
    <title>HD Print</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="<?php echo URL; ?>imagens/icon.ico">

	<script type="text/javascript" src="<?php echo URL; ?>lib/jquery/jquery-3.2.1.min.js"></script>


	<script src="<?php echo URL; ?>lib/bootstrap/dist/js/bootstrap.min.js"></script>
	<link href="<?php echo URL; ?>lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="<?php echo URL; ?>lib/dataTable/jquery.dataTables.min.js"></script>
  <link href="<?php echo URL; ?>lib/dataTable/dataTables.min.css" rel="stylesheet">

	<script src="<?php echo URL; ?>lib/custom-select-search/jquery-customselect.js"></script>
  <link href="<?php echo URL; ?>lib/custom-select-search/jquery-customselect.css" rel="stylesheet">

	<script src="<?php echo URL; ?>lib/custom-multi-select/js/jquery.multi-select.js"></script>
	<script src="<?php echo URL; ?>lib/custom-multi-select/js/jquery.quicksearch.js"></script>
  <link href="<?php echo URL; ?>lib/custom-multi-select/css/multi-select.css" rel="stylesheet">

  <link href="<?php echo URL; ?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
	<link href="<?php echo URL; ?>css/404.css" rel="stylesheet">
  <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
  <link href="<?php echo URL; ?>css/pastas.css" rel="stylesheet">

  <script>
    //--DESABILITA PRINT
    function printsreen(){

    }
    setInterval("printsreen();", 100);

    //-- DESABILITA CTRL C
    window.onkeydown = function(){
        var cntr = window.event.ctrlKey, tecla = window.event.keyCode;

        if(cntr == true && tecla == 65){ //cntrol A
            //alert("apertou control a");
            event.keyCode = 0;
            return false;
        }
        else if(cntr == true && tecla == 67){ //cntrol C
            event.keyCode = 0;
            return false;
        }
        else if(cntr == true && tecla == 86){ //cntrol V
            event.keyCode = 0;
            return false;
        }
    }

  </script>
</head>
<body>
  <div class="loading-area" id="loading-area" style="display:none;">
    <div class="loading-icon" id="loading-area">
      <div class="loading-content">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br>
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  </div>
  <!-- MENUS DINÂNICOS, LATERAL E SUPERIOR POR USUARIO:
    MAQUINA, USER, GERENTE, ADMIN
    CONFIGURAÇÃO PARA VERIFICAR SE VAI HABILITAR CADA MENU EM config/Configmenu.php
  -->
  <?php
    include APP . 'config/configMenu.php';
    $userType = (int)$_SESSION['usuario']->nivel_de_acesso;
    $isMenuLateral = false;
    $isMenuSuperior = false;
    if($userType == 0) {
      $user = 'maquina';
    }
    if($userType == 1) {
      $user = 'user';
    }
    if($userType == 2) {
      $user = 'gerente';
    }
    if($userType == 3) {
      $user = 'admin';
    }
    foreach ($configMenu as $array => $menuType) {
      if($array == $user) {
        if($menuType["usaMenuLateral"])
          $isMenuLateral = true;
        if($menuType["usaMenuSuperior"])
          $isMenuSuperior = true;
      }
    }
  ?>
  <div class="col-lg-12 col-md-12 col-xs-12 noPaddingMenu">
    <?php include 'menu/menuSuperior.tpl.php'; ?>
  </div>
  <div class="col-lg-2 col-md-4 col-xs-12 noPaddingMenu">
    <?php include 'menu/menu.tpl.php'; ?>
  </div>

  <div class="<?php echo $isMenuLateral ? 'col-lg-10 col-md-8 col-xs-12' : 'col-lg-12 col-md-12 col-xs-12';?>">
