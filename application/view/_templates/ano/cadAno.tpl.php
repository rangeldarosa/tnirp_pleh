<div class="cadAnoArea">
  <form action="<?php echo !isset($ano) ? URL.'ano/salvarAno' : '';?>" method="post">

    <div class="form-group">
      <label for="cadAnoNome">Ano</label>
      <input type="text" name="cadAnoNome" class="form-control input-controll-app" id="cadAnoNome" placeholder="Ano" required maxlength="255" value="<?php echo isset($ano) ? $ano->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadAnoStatus">Status</label>
      <select class="form-control select-controll-app" name="cadAnoStatus" id="cadAnoStatus" required>
        <option value="1" <?php echo isset($ano) && ($ano->ESTADO == 1) ? 'selected' : ''; ?>>Ativo</option>
        <option value="0" <?php echo isset($ano) && ($ano->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
