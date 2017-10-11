<?php
$userType = 3;

switch($userType) {
  case 1:
    include 'menuUser.tpl.php';
    break;
  case 2:
    include 'menuGerente.tpl.php';
    break;
  case 3:
    include 'menuAdmin.tpl.php';
}
?>
