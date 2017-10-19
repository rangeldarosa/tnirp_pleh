<div class="container-fluid">
  <h2 class="text-center">Listagem de Filial</h2><br>
  <?php
  include APP . 'view/_templates/alerts/alerts.tpl.php';
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cadastro de Filial</h3>
    </div>
    <div class="panel-body">
      <?php
      include APP . 'view/_templates/filial/cadFilial.tpl.php';
?>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Lista de Filial</h3>
    </div>
    <div class="panel-body">
      <?php
        include APP . 'view/_templates/filial/listFilial.tpl.php';
      ?>
    </div>
  </div>
</div>
