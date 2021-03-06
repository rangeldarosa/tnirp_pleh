<div class="container-fluid">
  <h2 class="text-center">Controle de Disciplinas</h2><br>
  <?php
  include APP . 'view/_templates/alerts/alerts.tpl.php';
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cadastro de Disciplinas</h3>
    </div>
    <div class="panel-body">
      <?php
      include APP . 'view/_templates/disciplina/cadDisciplina.tpl.php';
      ?>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Lista de Disciplinas</h3>
    </div>
    <div class="panel-body">
      <?php
        include APP . 'view/_templates/disciplina/listDisciplinas.tpl.php';
      ?>
    </div>
  </div>
</div>
