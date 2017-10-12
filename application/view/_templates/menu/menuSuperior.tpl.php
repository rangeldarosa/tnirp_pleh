<?php
switch($userType) {
  case 0:
    if($configMenu["maquina"]["usaMenuSuperior"])
      include 'menuSuperior/menuMaquina.tpl.php';
    break;
  case 1:
    if($configMenu["user"]["usaMenuSuperior"])
      include 'menuSuperior/menuUser.tpl.php';
    break;
  case 2:
    if($configMenu["gerente"]["usaMenuSuperior"])
      include 'menuSuperior/menuGerente.tpl.php';
    break;
  case 3:
    if($configMenu["admin"]["usaMenuSuperior"])
      include 'menuSuperior/menuSuperiorAdmin.tpl.php';
  break;
}
?>
