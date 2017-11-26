<div class="container-fluid">
  <h2 class="text-center">Controle de Usuários</h2><br>
  <?php
  include APP . 'view/_templates/alerts/alerts.tpl.php';
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cadastro de Usuários</h3>
    </div>
    <div class="panel-body">
      <?php
      include APP . 'view/_templates/usuario/cadUsuarios.tpl.php';
      ?>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Lista de Usuários</h3>
    </div>
    <div class="panel-body">
      <?php
        include APP . 'view/_templates/usuario/listUsuarios.tpl.php';
      ?>
    </div>
  </div>
</div>
