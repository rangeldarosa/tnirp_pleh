<script>
  $(document).on('change', '#cadArquivoInstituicao', function() {
    appConfig.clearCombo(true, true, true, true, true);
  });
  $(document).on('change', '#cadArquivoFilial', function() {
    appConfig.clearCombo(false, true, true, true, true);
  });
  $(document).on('change', '#cadArquivoAno', function() {
    appConfig.clearCombo(false, false, true, true, true);
  });
  $(document).on('change', '#cadArquivoCurso', function() {
    appConfig.clearCombo(false, false, false, true, true);
  });
  $(document).on('change', '#cadArquivoProfessor', function() {
    appConfig.clearCombo(false, false, false, false, true);
  });
</script>
<?php
if(isset($arquivo)) {

}
?>

<div class="cadArquivoArea">
  <form action="<?php echo !isset($arquivo) ? URL.'arquivo/salvarArquivo' : '';?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="cadArquivoNome">Nome do Arquivo</label>
      <input type="text" name="cadArquivoNome" class="form-control input-controll-app" id="cadArquivoNome" placeholder="Nome do Arquivo" required maxlength="255" value="<?php echo isset($arquivo) ? $arquivo->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoFile"><i class="fa fa-lg fa-file-pdf-o" aria-hidden="true"></i> Arquivo</label>
      <input type="file" name="cadArquivoFile" accept="application/pdf" class="form-control input-file-app" id="cadArquivoFile">
    </div>

    <div class="form-group">
      <label for="cadArquivoArqPrivado">Privado</label>
      <select class="form-control select-controll-app" name="cadArquivoArqPrivado" id="cadArquivoArqPrivado" required>
        <option value="1" <?php echo isset($arquivo) && ($arquivo->ARQUIVO_PRIVADO == 1) ? 'selected' : ''; ?>>Privado</option>
        <option value="0" <?php echo isset($arquivo) && ($arquivo->ARQUIVO_PRIVADO == 0) ? 'selected' : ''; ?>>Público</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cadArquivoPrivado">Status</label>
      <select class="form-control select-controll-app" name="cadArquivoEstado" id="cadArquivoEstado" required>
        <option value="1" <?php echo isset($arquivo) && ($arquivo->ESTADO == 1) ? 'selected' : ''; ?>>Ativo</option>
        <option value="0" <?php echo isset($arquivo) && ($arquivo->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>

      <hr>
    <div class="form-group">
      <label for="cadArquivoInstituicao">Instituição</label>
      <select id="cadArquivoInstituicao" onchange="appConfig.ajaxDynamicSimpleCombo('filial', 'buscarFilialPorInsituicaoCombo', '#loadComboFilial', 'limparComboFilialPorInstituicao', this.value)" class="select-controll-app" name="cadArquivoInstituicao" required>
          <<option value="">Selecione uma Instituição</option>
          <?php
            if (is_array($listarInstituicoesCombo)) {
              foreach ($listarInstituicoesCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_INSTITUICAO ?>" <?php echo isset($arquivo) && $key->CD_INSTITUICAO==$arquivo->CD_INSTITUICAO ? 'selected' : ''; echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_INSTITUICAO, 'UTF-8')?></option>
                <?php
              }
            }
          ?>
      </select>
    </div>

    <!-- CAMPO SELECT É CARREGADO ATRAVEZ DO AJAX DENTRO DA DIV-->
    <div id="loadComboFilial"></div>

    <div id="loadComboAno"></div>

    <div id="loadComboCurso"></div>

    <div id="loadComboProfessor"></div>

    <div id="loadComboDisciplina"></div>

    <div class="text-center">
      <a href="<?php echo URL;?>filial"><button type="button" class="btn btn-default btn-default-app"><i class="fa fa-arrow-left"></i> Casdastro de Filial</button></a>
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
    </div>

  </form>
</div>
