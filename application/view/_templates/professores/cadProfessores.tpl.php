<div class="cadProfessoresArea">
  <form action="<?php echo !isset($professor) ? URL.'professor/salvarProfessor' : URL.'professor/editarProfessor/'.$professor->CD_PROFESSOR;?>" method="post">

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
        <hr/>
    <div class="form-group">
      <label for="cadProfessoresStatus">Disciplinas</label>
      <select class="multi-select-app" multiple="multiple" name="cadProfessorDisciplina[]" required>
        <?php
        if(!empty($listaDisciplina) && is_array($listaDisciplina) && isset($listaDisciplina)) {
          foreach($listaDisciplina as $value) {
        ?>
          <option value="<?php echo $value->CD_DISCIPLINA ?>" <?php echo $value->ESTADO == 0 ? 'disabled' : '' ?>><?php echo $value->NOME?> </option>
        <?php
          }
        }
        if(!empty($listaDisciplinaRelacionada) && is_array($listaDisciplinaRelacionada) && isset($listaDisciplinaRelacionada)) {
          foreach($listaDisciplinaRelacionada as $valueRel) {
            ?>
              <option value="<?php echo $valueRel->CD_DISCIPLINA ?>" <?php echo $valueRel->ESTADO == 0 ? 'disabled' : '' ?> selected><?php echo $valueRel->NOME?> </option>
            <?php
          }
        }
        ?>
      </select>
    </div>

    <div class="text-center">
      <a href="<?php echo URL;?>disciplina"><input type="button" class="btn btn-default btn-default-app"  value="Casdastro de Disciplinas" ></a>
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
      <a href="<?php echo URL;?>curso"><input type="button" class="btn btn-default btn-default-app"  value="Casdastro de Curso" ></a>
    </div>

  </form>
</div>
