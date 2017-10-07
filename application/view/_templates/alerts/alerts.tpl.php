<?php
  if(isset($_SESSION["msgSucesso"])) {
?>
  <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successo!</strong> <?php echo $_SESSION["msgSucesso"] ?>
  </div>
<?php
  unset($_SESSION["msgSucesso"]);
  }
  if(isset($_SESSION["msgError"])) {
?>
  <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>ERROR!</strong> <?php echo $_SESSION["msgError"] ?>
  </div>
<?php
  unset($_SESSION["msgError"]);
  }
  if(isset($_SESSION["msgWarning"])) {
?>
  <div class="alert alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>ERROR!</strong> <?php echo $_SESSION["msgWarning"] ?>
  </div>
<?php
  unset($_SESSION["msgWarning"]);
  }
?>
