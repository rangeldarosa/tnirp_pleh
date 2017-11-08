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

    <hr/>
    <div class="form-group">
      <label for="cadAnosStatus">Cursos</label>
      <select class="multi-select-app" multiple="multiple" name="cadAnoCurso[]" required>
        <?php
        if(!empty($listaCurso) && is_array($listaCurso) && isset($listaCurso)) {
          foreach($listaCurso as $value) {
        ?>
          <option value="<?php echo $value->CD_CURSO ?>" <?php echo $value->ESTADO == 0 ? 'disabled' : '' ?>><?php echo $value->NOME?> </option>
        <?php
          }
        }
        if(!empty($listaCursoRelacionado) && is_array($listaCursoRelacionado) && isset($listaCursoRelacionado)) {
          foreach($listaCursoRelacionado as $valueRel) {
            ?>
              <option value="<?php echo $valueRel->CD_CURSO ?>" <?php echo $valueRel->ESTADO == 0 ? 'disabled' : '' ?> selected><?php echo $valueRel->NOME?> </option>
            <?php
          }
        }
        ?>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
