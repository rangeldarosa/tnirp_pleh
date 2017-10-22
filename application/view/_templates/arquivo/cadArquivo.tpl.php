<div class="cadArquivoArea">
  <form action="<?php echo !isset($arquivo) ? URL.'arquivo/salvarArquivo' : '';?>" method="post">

    <div class="form-group">
      <label for="cadArquivoNome">Nome do Arquivo</label>
      <input type="text" name="cadArquivoNome" class="form-control input-controll-app" id="cadArquivoNome" placeholder="Nome do Arquivo" required maxlength="255" value="<?php echo isset($arquivo) ? $arquivo->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoValorPeB">Valor Preto/Branco</label>
      <input type="text" name="cadArquivoValorPeB" class="form-control input-controll-app price" id="cadArquivoValorPeB" placeholder="Valor P/B" required maxlength="10" value="<?php echo isset($arquivo) ? $arquivo->VALOR_PRETO_E_BRANCO : ''; ?>">

    </div>
    <div class="form-group">
      <label for="cadArquivoValorColor">Valor Colorido</label>
      <input type="text" name="cadArquivoValorColor" class="form-control input-controll-app price" id="cadArquivoValorColor" placeholder="Valor Colorido" required maxlength="10" value="<?php echo isset($arquivo) ? $arquivo->VALOR_COLORIDO : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoPaginas">Número de Páginas</label>
      <input type="text" name="cadArquivoPaginas" class="form-control input-controll-app" id="cadArquivoPaginas" placeholder="Número de Páginas" required maxlength="10" value="<?php echo isset($arquivo) ? $arquivo->PAGINAS : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoCaminho">Caminho do Arquivo</label>
      <input type="text" name="cadArquivoCaminho" class="form-control input-controll-app" id="cadArquivoCaminho" placeholder="Caminho do Arquivo" required maxlength="255" value="<?php echo isset($arquivo) ? $arquivo->CAMINHO_PARA_O_ARQUIVO : ''; ?>">
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

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
