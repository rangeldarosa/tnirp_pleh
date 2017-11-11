<?php
  if(isset($listaProfessorCurso) && is_array($listaProfessorCurso)) {
?>
    <div class="form-group">
      <label for="cadArquivoProfessor">Professor</label>
      <select id="cadArquivoProfessor" onchange="appConfig.ajaxDynamicSimpleCombo('disciplina', 'buscarDisciplinaPorProfessorCombo', '#loadComboProfessor', 'limparComboDisciplinaPorProfessor', this.value+'/'+document.getElementById('cadArquivoInstituicao').value+'/'+document.getElementById('cadArquivoFilial').value+'/'+document.getElementById('cadArquivoAno').value+'/'+document.getElementById('cadArquivoCurso').value)" class="select-controll-app" name="cadArquivoProfessor" required>
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
      <label for="cadArquivoProfessor">Professor</label>
      <select id="cadArquivoProfessor" onchange="appConfig.ajaxDynamicSimpleCombo('disciplina', 'buscarDisciplinaPorProfessorCombo', '#loadComboProfessor', 'limparComboDisciplinaPorProfessor', this.value)" class="select-controll-app" name="cadArquivoProfessor" required>
        <option value="">Curso sem Professor ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
