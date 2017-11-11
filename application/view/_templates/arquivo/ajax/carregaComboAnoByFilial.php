<?php
  if(isset($listaAnoFilial) && is_array($listaAnoFilial)) {
?>
    <div class="form-group">
      <label for="cadArquivoAno">Ano</label>
      <select id="cadArquivoAno" onchange="appConfig.ajaxDynamicSimpleCombo('curso', 'buscarCursoPorAnoCombo', '#loadComboCurso', 'limparComboCursoPorAno', this.value+'/'+document.getElementById('cadArquivoInstituicao').value+'/'+document.getElementById('cadArquivoFilial').value)" class="select-controll-app" name="cadArquivoAno" required>
        <option value="">Selecione um Ano</option>
    <?php
      foreach ($listaAnoFilial as $key) {
          echo "<option value='$key->CD_ANO'>".mb_strtoupper($key->NOME, 'UTF-8')."</option>";
      }
    ?>
    </select>
    </div>
<?php
  } else {
?>
    <div class="form-group">
      <label for="cadArquivoAno">Ano</label>
      <select id="cadArquivoAno" onchange="appConfig.ajaxDynamicSimpleCombo('curso', 'buscarCursoPorAnoCombo', '#loadComboCurso', 'limparComboCursoPorAno', this.value)" class="select-controll-app" name="cadArquivoAno" required>
        <option value="">Filial sem Ano ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
