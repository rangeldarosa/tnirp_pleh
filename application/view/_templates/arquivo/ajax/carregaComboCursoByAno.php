<?php
  if(isset($listaCursoAno) && is_array($listaCursoAno)) {
?>
    <div class="form-group">
      <label for="cadArquivoCurso">Curso</label>
      <select id="cadArquivoCurso" onchange="appConfig.ajaxDynamicSimpleCombo('professor', 'buscarProfessorPorCursoCombo', '#loadComboCurso', 'limparComboProfessorPorCurso', this.value+'/'+document.getElementById('cadArquivoInstituicao').value+'/'+document.getElementById('cadArquivoFilial').value+'/'+document.getElementById('cadArquivoAno').value)" class="select-controll-app" name="cadArquivoCurso" required>
        <option value="">Selecione um Curso</option>
    <?php
      foreach ($listaCursoAno as $key) {
          echo "<option value='$key->CD_CURSO'>".mb_strtoupper($key->NOME, 'UTF-8')."</option>";
      }
    ?>
    </select>
    </div>
<?php
  } else {
?>
    <div class="form-group">
      <label for="cadArquivoCurso">Curso</label>
      <select id="cadArquivoCurso" onchange="appConfig.ajaxDynamicSimpleCombo('professor', 'buscarProfessorPorCursoCombo', '#loadComboCurso', 'limparComboProfessorPorCurso', this.value)" class="select-controll-app" name="cadArquivoCurso" required>
        <option value="">Ano sem Curso ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
