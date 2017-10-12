<div class="container-fluid">
  <h2 class="text-center">Listagem de professores</h2><br>
  <?php
  include APP . 'view/_templates/alerts/alerts.tpl.php';
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cadastro de Professores</h3>
    </div>
    <div class="panel-body">
      <?php
      include APP . 'view/_templates/professores/cadProfessores.tpl.php';
      ?>
    </div>
  </div>

  <!-- TODO  FALTA IMPLEMENTAR AS LISTAS -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Lista de Professores</h3>
    </div>
    <div class="panel-body">
      <?php
        include APP . 'view/_templates/professores/listProfessores.tpl.php';
      ?>
    </div>
  </div>
</div>
