<?php if(isset($listas[0]) && isset($listas[0]->PAGINAS) && !empty($listas[0]->PAGINAS) && $modo == 'openFile') { ?>
  <script>
    appConfig.ajaxDynamicSimple('pastas', 'loadImageFile', '#imgLoad', 'limparLoadImageFile', '1/<?php echo $listas[0]->CD_ARQUIVO; ?>');
    var pageAtual = 1;
    var limitePage = <?php echo $listas[0]->PAGINAS;?>;
    var priceColorido = <?php echo $_SESSION['usuario']->taxa_impressao_colorida;?>;
    var pricePretoEBranco = <?php echo $_SESSION['usuario']->taxa_impressao_pb;?> ;
    document.getElementById('input-control-page').value = pageAtual;
    var changePageFile = function (type) {
      if(type == 'next') {
        if(pageAtual < limitePage) {
          pageAtual++;
          appConfig.ajaxDynamicSimple('pastas', 'loadImageFile', '#imgLoad', 'limparLoadImageFile', pageAtual+'/<?php echo $listas[0]->CD_ARQUIVO; ?>');
        }
      }

      if(type == 'back') {
        if (pageAtual > 1) {
          pageAtual--;
          appConfig.ajaxDynamicSimple('pastas', 'loadImageFile', '#imgLoad', 'limparLoadImageFile', pageAtual+'/<?php echo $listas[0]->CD_ARQUIVO; ?>');
        }
      }

      if(type == 'change-to') {
        var pageToChange = document.getElementById('input-control-page').value;
        if (!isNaN(pageToChange)) {
          if(pageToChange < 1) {
            alert('Página Invalida');
          } else if(pageToChange > limitePage) {
            alert('O Documento Possuí apenas '+limitePage+" paginas");
          } else {
            pageAtual = pageToChange;
            appConfig.ajaxDynamicSimple('pastas', 'loadImageFile', '#imgLoad', 'limparLoadImageFile', pageToChange+'/<?php echo $listas[0]->CD_ARQUIVO; ?>');
          }
        } else {
          alert('Digite somente número no campo páginas');
        }
      }
      document.getElementById('input-control-page').value = pageAtual;
      disableButtons();
    }

    var disableButtons = function() {
      if(pageAtual == limitePage) {
        document.getElementById('paginator-next-page').style.display = 'none';
      }
      if(pageAtual == 1) {
        document.getElementById('paginator-back-page').style.display = 'none';
      }
      if(pageAtual > 1 && pageAtual < limitePage) {
        document.getElementById('paginator-next-page').style.display = 'block';
        document.getElementById('paginator-back-page').style.display = 'block';
      }
    }

    var cloneInterval = function(id) {
      $('#'+id).clone();
      $('#'+id).clone().insertAfter('#'+id);
    }

    var calcularPrecos = function() {
      var valIntervalsDe=[];
      var valIntervalsAte=[];
      var valIntervalsTipo=[];
       $('select[name="intervaloPaginasDe[]"] option:selected').each(function() {
        valIntervalsDe.push($(this).val());
       });
       $('select[name="intervaloPaginasaAte[]"] option:selected').each(function() {
        valIntervalsAte.push($(this).val());
       });
       $('select[name="intervaloPaginasTipo[]"] option:selected').each(function() {
        valIntervalsTipo.push($(this).val());
       });
       var priceTotal=0;
       for(var i=0; i<valIntervalsDe.length; i++) {
           var qtPaginas = (valIntervalsAte[i] - valIntervalsDe[i])+1;
           if(valIntervalsTipo[i] == 'COLORIDO') {
             priceTotal += qtPaginas * priceColorido;
           }
           if(valIntervalsTipo[i] == 'PRETO_BRANCO') {
             priceTotal += qtPaginas * pricePretoEBranco;
           }
       }
       var priceFormatado = priceTotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
       $('#valor_pagar').empty().append(priceFormatado);
    }

    disableButtons();
  </script>
<?php } ?>


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
    <!--<div class="row">
      <div class="col lg-12 col-sm-12 col-xs-12 col-md-12">
        <div class="form-busca">
          <form name="buscaFolder" class="form" id="formAjaxPost" onsubmit="appConfig.ajaxDynamicFormPost('#'+this.id, 'POST', false, '.container-pastas')" method="POST" action="<?php echo URL?>pastas/<?php echo $nextMethod; ?>/find/1/null/null/null/null/null/null/null">
          <div class="input-group stylish-input-group">
            <input type="text" class="form-control" name="searchValue" value="<?php echo isset($_POST['searchValue']) ? isset($_POST['searchValue']) : '';?>" placeholder="Pesquise por: Filial, Instituição, Ano, Curso, Professor, Disciplina ou Arquivo" />
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix" style="clear:both;"></div><br>-->
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
                    <span style="<?php echo $stylePricePB ?>">Valor Preto e Branco: <strong><?php echo Util::formatCashCurrent($_SESSION['usuario']->taxa_impressao_pb*$pasta->PAGINAS); ?></strong></span><br>
                    <span style="<?php echo $stylePriceColorido ?>">Valor Colorido: <strong><?php echo Util::formatCashCurrent($_SESSION['usuario']->taxa_impressao_colorida*$pasta->PAGINAS); ?></strong></span><br>
                    <span style="<?php echo $styleValorVariacao ?>"><?php echo VALOR_DESCRICAO_VARIACAO ?></span><br>
                  </div>
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
                  <a onclick="<?php echo isset($backMode) ? $backMode : '' ?>"><button class="btn btn-success btn-lg btn-default"><span class="glyphicon glyphicon glyphicon-arrow-left"></span> Voltar</button></a>
                  <a href="<?php echo URL?>pastas"><button class="btn btn-warning btn-lg btn-default"><span class="glyphicon glyphicon-home"></span> Ir para o Início</button></a>

                </div>
              </div>
          </div>
        </div>
        <?php
      }
    ?>
  </section>
  <?php if($modo == 'openFile') {
    $pasta = $listas[0];
    ?>
    <div class="openFile">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
          <div class="paginator paginatorLeft">
            <a id="paginator-back-page" class="previous round" onclick="changePageFile('back')"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
          </div>
          <div class="paginator paginatorRight">
            <a id="paginator-next-page" class="next round" onclick="changePageFile('next')"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
          </div>

          <div id="imgLoad">
          </div>

           <div class="text-center">
             <label for="input-control-page"> Ir para Página: </label>
             <input type="text" class="form-control select-min-interval" id="input-control-page"/>
             <button class="btn btn-md btn-default" onclick="changePageFile('change-to')">Ir <i class="fa fa-ok"></i></button>
           </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><strong>Dados do Arquivo:</strong></h3>
            </div>
            <div class="panel-body">
              <span><strong>Nome do Arquivo:</strong> <?php echo mb_strtoupper($pasta->NMARQUIVO,'UTF-8');?></span><br>
              <span><strong>Paginas:</strong> <?php echo mb_strtoupper($pasta->PAGINAS,'UTF-8');?> PÁGINAS</span><br>
              <span><strong>Instituição:</strong> <?php echo mb_strtoupper($pasta->NOME_INSTITUICAO,'UTF-8');?></span><br>
              <span><strong>Filial:</strong> <?php echo mb_strtoupper($pasta->NOME_FILIAL,'UTF-8');?></span><br>
              <span><strong>Curso:</strong> <?php echo mb_strtoupper($pasta->NOME_CURSO,'UTF-8');?></span><br>
              <span><strong>Professor:</strong><?php echo mb_strtoupper($pasta->NOME_PROFESSOR,'UTF-8');?></span><br>
              <span><strong>Matéria:</strong> <?php echo mb_strtoupper($pasta->NOME_DISCIPLINA,'UTF-8');?></span>
            </div>
          </div>
          <form method="POST" action="<?php echo URL?>pastas/adicionarAFila">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><strong>Valores: </strong></h3>
            </div>
            <div class="panel-body">
              <span><strong>Valor Preto e Branco:</strong> </span><?php echo Util::formatCashCurrent($_SESSION['usuario']->taxa_impressao_pb); ?><br>
              <span><strong>Valor Colorido:</strong> </span><?php echo Util::formatCashCurrent($_SESSION['usuario']->taxa_impressao_colorida); ?>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><strong>Imprimir:</strong></h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="nomeAlunoFila" name="nomeAlunoFila" required placeholder="Digite seu Nome:">
                </div>
                  <hr>
                  <strong>Intervalo de Páginas: </strong><br><br>
                  <div class="group-interval-repeat" id="group-interval-repeat">
                      <label>De:</label>
                      <select class="select-controll-app select-min-interval" name="intervaloPaginasDe[]">
                        <option value=""> Início do Intervalo</option>
                      <?php for($i=1;$i<=$pasta->PAGINAS;$i++) {?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                      </select>
                      <label style="margin-left: 5px;margin-right:5px">Até</label>
                      <select class="select-controll-app select-min-interval" name="intervaloPaginasaAte[]">
                        <option value="">Final do Intervalo</option>
                      <?php for($i=1;$i<=$pasta->PAGINAS;$i++) {?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                      </select>
                      <select class="select-controll-app" name="intervaloPaginasTipo[]">
                        <option value="">Tipo de Impressão</option>
                        <option value="PRETO_BRANCO">Preto e Branco</option>
                        <option value="COLORIDO">Colorido</option>
                      </select>
                  </div><br>
                  <div class="text-center" style="margin: 0 auto;">
                    <button type="button" style="width: 49.3%" name="buttom-repeat-interval" onclick="cloneInterval('group-interval-repeat')" class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i> Mais Intervalos</button>
                    <button type="button" style="width: 49.3%" name="buttom-repeat-interval" onclick="calcularPrecos()" class="btn btn-default"><i class="fa fa-calculator" aria-hidden="true"></i> Calcular Preço</button>
                  </div>
                  <hr>
            </div>
          </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Adicionar a Fila</h3>
              </div>
              <div class="panel-body">
                <input name="NMARQUIVO" type="hidden" value="<?php echo $pasta->NMARQUIVO;?>">
                <input name="CD_ARQUIVO" type="hidden" value="<?php echo $pasta->CD_ARQUIVO;?>">
                <input name="CAMINHO_PARA_O_ARQUIVO" type="hidden" value="<?php echo $pasta->CAMINHO_PARA_O_ARQUIVO;?>">
                <input name="PAGINAS_TOTAL" type="hidden" value="<?php echo $pasta->PAGINAS;?>">
                <span id="valor_pagar" style="font-weight:bold;color:#F00;">R$0,00</span><br><br>
                <button type="submit" name="adicionarAFila" class="btn btn-default btn-block"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              </div>
            </div>
            </form>
            <div id="areaLoadTest">
            </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
