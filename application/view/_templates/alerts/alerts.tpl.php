<?php
  if(isset($_SESSION["msgSucesso"])) {
?>
  <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?php echo isset($_SESSION["msgSucesso"]["titulo"]) ? $_SESSION["msgSucesso"]["titulo"] : "SUCESSO"?></strong>
     <?php echo isset($_SESSION["msgSucesso"]["detalhes"]) ? $_SESSION["msgSucesso"]["detalhes"] : "" ?>
     <?php echo isset($_SESSION["msgSucesso"]["causa"]) ? $_SESSION["msgSucesso"]["causa"] : "" ?>
  </div>
<?php
  unset($_SESSION["msgSucesso"]);
  }
  if(isset($_SESSION["msgErro"])) {
?>
  <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?php echo isset($_SESSION["msgErro"]["titulo"]) ? $_SESSION["msgErro"]["titulo"] : "ERROR"?></strong></br>
     <?php echo isset($_SESSION["msgErro"]["detalhes"]) ? "<strong>Detalhes: </strong>".$_SESSION["msgErro"]["detalhes"]."</br>" : "" ?>
     <?php echo isset($_SESSION["msgErro"]["causa"]) ? "<strong>Causa:</strong> ".$_SESSION["msgErro"]["causa"] : "" ?>
  </div>
<?php
  unset($_SESSION["msgErro"]);
  }
  if(isset($_SESSION["msgWarning"])) {
?>
  <div class="alert alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?php echo isset($_SESSION["msgWarning"]["titulo"]) ? $_SESSION["msgWarning"]["titulo"] : "WARNING"?></strong></br>
     <?php echo isset($_SESSION["msgWarning"]["detalhes"]) ? "<strong>Detalhes: </strong>".$_SESSION["msgWarning"]["detalhes"]."</br>" : "" ?>
     <?php echo isset($_SESSION["msgWarning"]["causa"]) ? "<strong>Causa:</strong> ".$_SESSION["msgWarning"]["causa"] : "" ?>
  </div>
<?php
  unset($_SESSION["msgWarning"]);
  }
?>
