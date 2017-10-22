<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HD Print</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="<?php echo URL; ?>imagens/icon.ico">

	<script type="text/javascript" src="<?php echo URL; ?>lib/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?php echo URL; ?>lib/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo URL; ?>lib/dataTable/jquery.dataTables.min.js"></script>
	<script src="<?php echo URL; ?>lib/dataTable/initDataTable.js"></script>

	<link href="<?php echo URL; ?>lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL; ?>lib/dataTable/dataTables.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
	<link href="<?php echo URL; ?>css/404.css" rel="stylesheet">
  <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
  <!-- MENUS DINÂNICOS, LATERAL E SUPERIOR POR USUARIO:
    MAQUINA, USER, GERENTE, ADMIN
    CONFIGURAÇÃO PARA VERIFICAR SE VAI HABILITAR CADA MENU EM config/Configmenu.php
  -->
  <?php
    include APP . 'config/configMenu.php';
    $userType = 3;
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
