<div class="cadCursoArea">
  <form action="<?php echo !isset($curso) ? URL.'curso/salvarCurso' : '';?>" method="post">

    <div class="form-group">
      <label for="cadCursoNome">Nome do Curso</label>
      <input type="text" name="cadCursoNome" class="form-control input-controll-app" id="cadCursoNome" placeholder="Nome do Curso" required maxlength="255" value="<?php echo isset($curso) ? $curso->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadCursoStatus">Status</label>
      <select class="form-control select-controll-app" name="cadCursoStatus" id="cadCursoStatus" required>
        <option value="1" <?php echo isset($curso) && ($curso->ESTADO == 1) ? 'selected' : ''; ?>>Ativo</option>
        <option value="0" <?php echo isset($curso) && ($curso->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
