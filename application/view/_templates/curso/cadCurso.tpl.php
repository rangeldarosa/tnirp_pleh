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

    <hr/>
    <div class="form-group">
      <label for="cadCursosStatus">Professores</label>
      <select class="multi-select-app" multiple="multiple" name="cadCursoProfessor[]" required>
        <?php
        if(!empty($listaProfessor) && is_array($listaProfessor) && isset($listaProfessor)) {
          foreach($listaProfessor as $value) {
        ?>
          <option value="<?php echo $value->CD_PROFESSOR?>" <?php echo $value->ESTADO == 0 ? 'disabled' : '' ?>><?php echo $value->NOME?> </option>
        <?php
          }
        }
        if(!empty($listaProfessorRelacionado) && is_array($listaProfessorRelacionado) && isset($listaProfessorRelacionado)) {
          foreach($listaProfessorRelacionado as $valueRel) {
            ?>
              <option value="<?php echo $valueRel->CD_PROFESSOR ?>" <?php echo $valueRel->ESTADO == 0 ? 'disabled' : '' ?> selected><?php echo $valueRel->NOME?> </option>
            <?php
          }
        }
        ?>
      </select>
    </div>

    <div class="text-center">
      <a href="<?php echo URL;?>professor"><input type="button" class="btn btn-default btn-default-app"  value="Casdastro de Professor" ></a>
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
      <a href="<?php echo URL;?>ano"><input type="button" class="btn btn-default btn-default-app"  value="Casdastro de Ano" ></a>
    </div>

  </form>
</div>
