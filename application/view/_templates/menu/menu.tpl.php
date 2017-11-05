<?php
switch($userType) {
  case 0:
    if($configMenu["maquina"]["usaMenuLateral"])
      include 'menuLateral/menuAdmin.tpl.php';
    break;
  case 1:
    if($configMenu["user"]["usaMenuLateral"])
      include 'menuLateral/menuAdmin.tpl.php';
    break;
  case 2:
    if($configMenu["gerente"]["usaMenuLateral"])
      include 'menuLateral/menuAdmin.tpl.php';
    break;
  case 3:
    if($configMenu["admin"]["usaMenuLateral"])
      include 'menuLateral/menuAdmin.tpl.php';
  break;
}
?>
