<?php
  if(isset($listaProfessorCurso) && is_array($listaProfessorCurso)) {
?>
    <div class="form-group">
      <label for="cadArquivoCurso">Ano</label>
      <select id="carregaComboProfessorByCurso" class="form-control select-controll-app" name="cadArquivoProfessor" required>
        <option value="">Selecione um Professor</option>
    <?php
      foreach ($listaProfessorCurso as $key) {
          echo "<option value='$key->CD_PROFESSOR'>".mb_strtoupper($key->NOME, 'UTF-8')."</option>";
      }
    ?>
    </select>
    </div>
<?php
  } else {
?>
    <div class="form-group">
      <label for="cadArquivoCurso">Professor</label>
      <select id="carregaComboProfessorByCurso" style="border: 1px solid #F00" class="form-control select-controll-app" name="cadArquivoProfessor" required>
        <option value="">Curso sem Professor ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
