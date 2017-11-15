<div class="container-fluid">
    <br>
    <?php
    include APP . 'view/_templates/alerts/alerts.tpl.php';
    ?>

    <?php
      if($_SESSION['usuario']->nivel_de_acesso == 3) {
    ?>
    <h3 class="title text-center">Dashboard</h3><br>
  <!-- POR FILIAL -->
        <?php foreach ($dashBoardItens as $item) {?>
      <div class="row">
        <div class="col-lg-12">
          <h4><strong><?php echo $item['NOME']; ?></strong></h4>
        </div><br><br>
          <div class="panel panel-default">
            <div class="panel-heading"> <h3 class="panel-title">Itens Na Fila</h3>  </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-vcenter table-list">
                <thead>
                      <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
                      <th>Aluno <span class="glyphicon glyphicon-sort"></span></th>
                      <th>Usuário <span class="glyphicon glyphicon-sort"></span></th>
                      <th>Arquivo <span class="glyphicon glyphicon-sort"></span></th>
                      <th>Status Atual <span class="glyphicon glyphicon-sort"></span></th>
                      <th>Ação <span class="glyphicon glyphicon-sort"></span></th>
                </thead>
                <tbody>
            <?php foreach ($item['fila_atual'] as $fila) {
                if($fila->STATUSATUAL == -1)
                  $statusAtual = 'Cancelado';
                else if($fila->STATUSATUAL == 0)
                  $statusAtual = 'Aguardando Impressão';
                else if ($fila->STATUSATUAL == 1)
                  $statusAtual = 'Em Impressão';
                else
                  $statusAtual = 'Impresso';
                ?>
                <tr>
                    <td class="text-center"><?php echo $fila->CD_REQUISICAO;?></td>
                    <td class="text-left"><?php echo $fila->NOME;?></td>
                    <td class="text-left"><?php echo $fila->nmUsuario;?></td>
                    <td class="text-center"><a href="<?php echo URL.'documentos/getFile/'.$fila->link?>" target="_blank"><i class="fa fa-file-pdf-o"></i> <?php echo $fila->nmArquivo;?></a></td>
                    <td class="text-center"><strong><?php echo $statusAtual ?></strong></td>
                    <td class="text-center">
                    <?php if($fila->STATUSATUAL == 0) { ?>
                      <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/1'?>"><button><i class="fa fa-print"></i> Iniciar Impressão</button></a>
                    <?php }
                    if($fila->STATUSATUAL == 1) { ?>
                      <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/2'?>"><button><i class="glyphicon glyphicon-ok"></i> Finalizar Impressão</button></a>
                    <?php
                    }
                    ?>
                    <?php if($fila->STATUSATUAL > 0) { ?>
                    <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/'.($fila->STATUSATUAL-1);?>"><button><i class="fa fa-arrow-left"></i> Voltar Status</button></a>
                  <?php } ?>
                    <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/-1'?>"><button><i class="fa fa-times"></i> Cancelar Impressão</button></a>
                    </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong>Folhas Impressas</strong></h3>
                </div>
                <div class="panel-body">
                    <span class="pages-detail"><strong>Páginas Preto e Branco:</strong> <?php echo $item['totalPbImpresso']; ?> Folhas</span><br>
                    <span class="pages-detail"><strong>Páginas Colorida:</strong> <?php echo $item['totalColoridoImpresso']; ?> Folhas</span><br>
                    <span class="pages-detail"><strong>Páginas Totais:</strong> <?php echo $item['totalImpresso']; ?> Folhas</span><br>
                </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-3 col-sm-6 col-xs-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><strong>Lucro</strong></h3>
                </div>
                <div class="panel-body">
                    <span class="pages-detail"><strong>Preto e Branco:</strong><span style="font-weight:bold;color:#F00;"> <?php echo Util::formatCashCurrent($item['ValorPbImpresso']); ?></span></span><br>
                    <span class="pages-detail"><strong>Colorido:</strong><span style="font-weight:bold;color:#F00;"> <?php echo Util::formatCashCurrent($item['ValorColoridoImpresso']); ?></span></span><br>
                    <span class="pages-detail"><strong>Totais:</strong><span style="font-weight:bold;color:#F00;"> <?php echo Util::formatCashCurrent($item['ValorPbImpresso']+$item['ValorColoridoImpresso']); ?></span></span><br>
                </div>
              </div>
          </div>
        </div>
        </hr><br>

    <?php
    }
  } else {
    ?>
    <h3 class="title text-center">Fila de Impressão</h3>
    <div class="panel panel-default">
      <div class="panel-heading"> <h3 class="panel-title">Itens Na Fila</h3>  </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-vcenter table-list">
          <thead>
                <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
                <th>Aluno <span class="glyphicon glyphicon-sort"></span></th>
                <th>Usuário <span class="glyphicon glyphicon-sort"></span></th>
                <th>Arquivo <span class="glyphicon glyphicon-sort"></span></th>
                <th>Status Atual <span class="glyphicon glyphicon-sort"></span></th>
                <th>Ação <span class="glyphicon glyphicon-sort"></span></th>
          </thead>
          <tbody>
      <?php foreach ($filaImpressaoItens as $fila) {
          if($fila->STATUSATUAL == -1)
            $statusAtual = 'Cancelado';
          else if($fila->STATUSATUAL == 0)
            $statusAtual = 'Aguardando Impressão';
          else if ($fila->STATUSATUAL == 1)
            $statusAtual = 'Em Impressão';
          else
            $statusAtual = 'Impresso';
          ?>
          <tr>
              <td class="text-center"><?php echo $fila->CD_REQUISICAO;?></td>
              <td class="text-left"><?php echo $fila->NOME;?></td>
              <td class="text-left"><?php echo $fila->nmUsuario;?></td>
              <td class="text-center"><a href="<?php echo URL.'documentos/getFile/'.$fila->link?>" target="_blank"><i class="fa fa-file-pdf-o"></i> <?php echo $fila->nmArquivo;?></a></td>
              <td class="text-center"><strong><?php echo $statusAtual ?></strong></td>
              <td class="text-center">
              <?php if($fila->STATUSATUAL == 0) { ?>
                <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/1'?>"><button><i class="fa fa-print"></i> Iniciar Impressão</button></a>
              <?php }
              if($fila->STATUSATUAL == 1) { ?>
                <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/2'?>"><button><i class="glyphicon glyphicon-ok"></i> Finalizar Impressão</button></a>
              <?php
              }
              ?>
              <?php if($fila->STATUSATUAL > 0) { ?>
              <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/'.($fila->STATUSATUAL-1);?>"><button><i class="fa fa-arrow-left"></i> Voltar Status</button></a>
            <?php } ?>
              <a href="<?php echo URL.'home/changeStatus/'.$fila->CD_REQUISICAO.'/-1'?>"><button><i class="fa fa-times"></i> Cancelar Impressão</button></a>
              </td>
          </tr>
          <?php
            }
          ?>



    <?php } ?>
</div>
