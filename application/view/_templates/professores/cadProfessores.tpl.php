<div class="cadProfessoresArea">
  <form action="<?php echo URL; ?>professor/salvarProfessor" method="post">
    <div class="form-group">
      <label for="cadProfessoresNome">Nome da Professor</label>
      <input type="text" name="cadProfessoresNome" class="form-control input-controll-app" id="cadProfessoresNome" placeholder="Nome do Professor" required maxlength="60">
    </div>
    <div class="form-group">
      <label for="cadProfessoresStatus">Status</label>
      <select class="form-control select-controll-app" name="cadProfessoresStatus" id="cadProfessoresStatus" required>
        <option value="1">Ativo</option>
        <option value="0">Inativo</option>
      </select>
    </div>
    <div class="form-group">
      <label for="cadProfessoresPrivado">Privado</label>
      <select class="form-control select-controll-app" name="cadProfessoresPrivado" id="cadProfessoresPrivado" required>
        <option value="1">Privado</option>
        <option value="0">Público</option>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>
  </form>
</div>
