<?php if(isset($backMode) && !empty($backMode)) { ?>
  <button class="btn btn-lg btn-default" onclick="<?php echo $backMode ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button><br><br>
<?php } ?>

<?php if (isset($navTopAtual) && !empty($navTopAtual) && is_array($navTopAtual) && $showNavTop) { ?>
<ol class="breadcrumb">
  <?php foreach ($navTopAtual as $key) {
    if(isset($key['nome']) && !empty($key['nome']))  {
    ?>
    <?php if(!$key['active']) { ?>
      <li><a href="#" onclick="<?php echo $key['link']; ?>"><?php echo $key['nome']; ?></a></li>
    <?php } else { ?>
      <li class="active"><?php echo $key['nome']; ?></li>
  <?php }
      }
    } ?>
</ol>
<?php } ?>

<div class="panel panel-default" id="loadPastas">
  <div class="panel-heading">
    <h3 class="panel-title"><strong><?php echo $modelTitle ?></strong></h3>
  </div>
  <div class="panel-body">
    <section class="container-pastas">
    <?php
      if(!empty($listas) && is_array($listas)) {
        foreach ($listas as $pasta) {
    ?>
          <?php if($modo == 'instituicao') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $pasta->CD_INSTITUICAO?>/null/null/null/null/null/null')">
                  <div class="pastas-container-item">
                    <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                    <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME_INSTITUICAO, 'UTF-8'); ?></span>
                  </div>
              </div>
          <?php } ?>
          <?php if($modo == 'filial') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $pasta->CD_FILIAL?>/null/null/null/null/null')">
                  <div class="pastas-container-item">
                    <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                    <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                    <span style="<?php echo $styleTypeSubName ?>"><?php echo  mb_strtoupper($pasta->NOME_CIDADE, 'UTF-8'); ?> - <?php echo  mb_strtoupper($pasta->nmestado, 'UTF-8'); ?></span>
                  </div>
              </div>
          <?php } ?>
          <?php if($modo == 'ano') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $pasta->CD_ANO?>/null/null/null/null')">
                <div class="pastas-container-item">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'curso') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $idAnoView?>/<?php echo $pasta->CD_CURSO?>/null/null/null/null')">
                <div class="pastas-container-item">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'professor') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $idAnoView?>/<?php echo $idCursoView?>/<?php echo $pasta->CD_PROFESSOR?>/null/null/null')">
                <div class="pastas-container-item">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'disciplina') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $idAnoView?>/<?php echo $idCursoView?>/<?php echo $idProfessorView?>/<?php echo $pasta->CD_DISCIPLINA?>/null/null')">
                <div class="pastas-container-item">
                  <img src="<?php echo URL?>public/img/folder.ico" width="100%" />
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NOME, 'UTF-8');?></span><br/>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'arquivo') { ?>
              <div class="<?php echo $gridType; ?> pastas-container" onclick="appConfig.ajaxDynamicSimple('pastas', '<?php echo $nextMethod; ?>', '#loadPastas', 'limparPastasByPages', '<?php echo $nextType; ?>/1/<?php echo $idInstituicaoView ?>/<?php echo $idFilialView?>/<?php echo $idAnoView?>/<?php echo $idCursoView?>/<?php echo $idProfessorView?>/<?php echo $idDisciplinaView?>/<?php echo $pasta->CD_ARQUIVO?>/null')">
                <div class="pastas-container-item">
                  <img src="<?php echo URL?>public/img/pdf.png" width="70%" /><br/>
                  <span style="<?php echo $styleTypeName ?>"><?php echo  mb_strtoupper($pasta->NMARQUIVO, 'UTF-8');?></span><br/>
                  <span style="<?php echo $styleTypeSubName ?>"><?php echo  $pasta->PAGINAS ?> Paginas</span><br>
                  <div style="margin-top: 10px;">
                    <span style="<?php echo $stylePricePB ?>">Valor Preto e Branco: <strong><?php echo Util::formatCashCurrent($pasta->VALOR_PRETO_E_BRANCO*$pasta->PAGINAS); ?></strong></span><br>
                    <span style="<?php echo $stylePriceColorido ?>">Valor Colorido: <strong><?php echo Util::formatCashCurrent($pasta->VALOR_COLORIDO*$pasta->PAGINAS); ?></strong></span><br>
                    <span style="<?php echo $styleValorVariacao ?>"><?php echo VALOR_DESCRICAO_VARIACAO ?></span><br>
                  </div>
                </div>
              </div>
          <?php } ?>
          <?php if($modo == 'openFile') { ?>
            <div class="openFile">
              <div style='position:relative; overflow:hidden; display: inline-block; border:1px solid red; width:80%'>
              <img src="<?php echo $base64; ?>" width='100%' />
              <div style='position:absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.0)'></div>
              </div>
              <?php var_dump($pasta);?>
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
                  <a href="<?php echo URL?>pastas"><button class="btn btn-warning btn-lg btn-default"><span class="glyphicon glyphicon-home"></span> Ir para o Início</button></a>

                </div>
              </div>
          </div>
        </div>
        <?php
      }
    ?>
  </section>
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
