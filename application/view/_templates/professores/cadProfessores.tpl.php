<div class="cadProfessoresArea">
  <form action="<?php echo !isset($professor) ? URL.'professor/salvarProfessor' : '';?>" method="post">

    <div class="form-group">
      <label for="cadProfessoresNome">Nome da Professor</label>
      <input type="text" name="cadProfessoresNome" class="form-control input-controll-app" id="cadProfessoresNome" placeholder="Nome do Professor" required maxlength="255" value="<?php echo isset($professor) ? $professor->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadProfessoresPrivado">Privado</label>
      <select class="select-controll-app" name="cadProfessoresPrivado" id="cadProfessoresPrivado" required>
        <option value="1" <?php echo isset($professor) && ($professor->PRIVADO == 1) ? 'selected' : ''; ?>>Privado</option>
        <option value="0" <?php echo isset($professor) && ($professor->PRIVADO == 0) ? 'selected' : ''; ?>>Público</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cadProfessoresStatus">Status</label>
      <select class="select-controll-app" name="cadProfessoresStatus" required>
        <option value="1" <?php echo isset($professor) && ($professor->ESTADO == 1) ? 'selected' : ''; ?>>Ativo</option>
        <option value="0" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>
    <div class="form-group">
      <label for="cadProfessoresStatus">Disciplinas</label>
      <select class="multi-select-app" multiple="multiple" name="cadProfessorDisciplina[]" required>
        <option value="1" selected>Ativo</option>
        <option value="2" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
        <option value="3" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
        <option value="4" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
        <option value="5" selected>Inativo</option>
        <option value="6" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
        <option value="7" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
        <option value="8" <?php echo isset($professor) && ($professor->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
