<?php if(isset($backMode) && !empty($backMode)) { ?>
  <button class="btn btn-lg btn-default" onclick="<?php echo $backMode ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button><br><br>
<?php } ?>
<div class="panel panel-default" id="loadPastas">
  <div class="panel-heading">
    <h3 class="panel-title"><strong><?php echo $modelTitle ?></strong></h3>
  </div><!--var_dump($idPastaView)-->
  <div class="panel-body">
    <?php
      if(!empty($listas) && is_array($listas)) {
        foreach ($listas as $pasta) {
    ?>
          <?php if($modo == 'instituicao') { ?>
              <div class="<?php echo $gridType ?>" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $pasta->CD_INSTITUICAO?>/null/null/null/null/null/null')">
                <div class="pastas-container text-center">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME_INSTITUICAO, 'UTF-8'); ?></span>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'filial') { ?>
              <div class="<?php echo $gridType ?>" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $pasta->CD_FILIAL?>/null/null/null/null/null')">
                <div class="pastas-container text-center">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                  <span style="<?php echo $styleTypeSubName ?>"><?php echo  mb_strtoupper($pasta->NOME_CIDADE, 'UTF-8'); ?> - <?php echo  mb_strtoupper($pasta->nmestado, 'UTF-8'); ?></span>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'ano') { ?>
              <div class="<?php echo $gridType ?>" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $pasta->CD_ANO?>/null/null/null/null')">
                <div class="pastas-container text-center">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'curso') { ?>
              <div class="<?php echo $gridType ?>" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $idCursoView?>/<?php echo $pasta->CD_CURSO?>/null/null/null')">
                <div class="pastas-container text-center">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                </div>
              </div>
          <?php } ?>
    <?php
        }
      } else {
        ?>
        <div class="error404Area">
          <div class="container-fluid">
              <div class="alert alert-danger">
                <div class="titleError">
                  <span class="glyphicon glyphicon-remove-sign"></span>
                  <strong>404 - Nenhum Arquivo Aqui</strong>
                </div>
                <div class="message">
                  <strong>Oooopss! Algo Errado Aconteceu</strong><br>
                  Experimente alguma ação abaixo<br>
                  <a onclick="<?php echo $backMode ?>"><button class="btn btn-success btn-lg btn-default"><span class="glyphicon glyphicon glyphicon-arrow-left"></span> Voltar</button></a>
                  <a href="<?php echo URL?>"><button class="btn btn-warning btn-lg btn-default"><span class="glyphicon glyphicon-home"></span> Ir para o Início</button></a>

                </div>
              </div>
          </div>
        </div>
        <?php
      }
    ?>
  </div>
  <!--
  <div class="panel-footer text-center">
    <ul class="pagination" style="margin: 0; padding:0;">
      <li><a onclick="appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'instituicao/1/null')">Anterior</a></li>
      <li class="disabled"><a>1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li class="next"><a href="#" rel="next">Próximo</a></li>
    </ul>
  </div>
  -->
</div>
