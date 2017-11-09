<?php
  if(isset($listaCursoAno) && is_array($listaCursoAno)) {
?>
    <div class="form-group">
      <label for="cadArquivoAno">Ano</label>
      <select id="carregaComboCursoByAno" class="form-control select-controll-app" name="cadArquivoCurso" required>
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
      <label for="cadArquivoAno">Curso</label>
      <select id="carregaComboCursoByAno" style="border: 1px solid #F00" class="form-control select-controll-app" name="cadArquivoCurso" required>
        <option value="">Ano sem Curso ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
