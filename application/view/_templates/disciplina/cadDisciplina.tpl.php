<div class="cadDisciplinaArea">
  <form action="<?php echo !isset($disciplina) ? URL.'disciplina/salvarDisciplina' : '';?>" method="post">

    <div class="form-group">
      <label for="cadDisciplinaNome">Nome da Disciplina</label>
      <input type="text" name="cadDisciplinaNome" class="form-control input-controll-app" id="cadDisciplinaNome" placeholder="Nome da Disciplina" required maxlength="255" value="<?php echo isset($disciplina) ? $disciplina->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadDisciplinaPrivada">Privado</label>
      <select class="form-control select-controll-app" name="cadDisciplinaPrivada" id="cadDisciplinaPrivada" required>
        <option value="1" <?php echo isset($disciplina) && ($disciplina->PRIVADO == 1) ? 'selected' : ''; ?>>Privado</option>
        <option value="0" <?php echo isset($disciplina) && ($disciplina->PRIVADO == 0) ? 'selected' : ''; ?>>Público</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cadDisciplinaStatus">Status</label>
      <select class="form-control select-controll-app" name="cadDisciplinaStatus" id="cadDisciplinaStatus" required>
        <option value="">Selecione o Status da Disciplina</option>
        <option value="1" <?php echo isset($disciplina) && ($disciplina->ESTADO == 1) ? 'selected' : ''; ?>>Ativo</option>
        <option value="0" <?php echo isset($disciplina) && ($disciplina->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>

    <div class="text-center">
      <a href="<?php echo URL;?>instituicao"><button type="button" class="btn btn-default btn-default-app"><i class="fa fa-arrow-left"></i> Casdastro de Instituição</button></a>
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
      <a href="<?php echo URL;?>professor"><button type="button" class="btn btn-default btn-default-app">Casdastro de Professor <i class="fa fa-arrow-right"></i></button></a>
    </div>
  </form>
</div>
