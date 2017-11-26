<div class="container-fluid">
  <h2 class="text-center">Controle de Instituição</h2><br>
  <?php
  include APP . 'view/_templates/alerts/alerts.tpl.php';
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Cadastro de Instituição</h3>
    </div>
    <div class="panel-body">
      <?php
      include APP . 'view/_templates/instituicao/cadInstituicao.tpl.php';
      ?>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Lista de Instituição</h3>
    </div>
    <div class="panel-body">
      <?php
        include APP . 'view/_templates/instituicao/listInstituicoes.tpl.php';
      ?>
    </div>
  </div>
