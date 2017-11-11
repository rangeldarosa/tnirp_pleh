<?php
  if(isset($listaDisciplinaProfessor) && is_array($listaDisciplinaProfessor)) {
?>
    <div class="form-group">
      <label for="cadArquivoDisciplina">Disciplina</label>
      <select id="cadArquivoDisciplina" class="form-control select-controll-app" name="cadArquivoDisciplina" required>
        <option value="">Selecione um Disciplina</option>
    <?php
      foreach ($listaDisciplinaProfessor as $key) {
          echo "<option value='$key->CD_DISCIPLINA'>".mb_strtoupper($key->NOME, 'UTF-8')."</option>";
      }
    ?>
    </select>
    </div>
<?php
  } else {
?>
    <div class="form-group">
      <label for="cadArquivoDisciplina">Disciplina</label>
      <select id="cadArquivoDisciplina" style="border: 1px solid #F00" class="form-control select-controll-app" name="cadArquivoDisciplina" required>
        <option value="">Professor sem Disciplina ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
