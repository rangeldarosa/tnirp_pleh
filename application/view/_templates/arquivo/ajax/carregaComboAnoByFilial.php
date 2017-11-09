<?php
  if(isset($listaAnoFilial) && is_array($listaAnoFilial)) {
?>
    <div class="form-group">
      <label for="cadArquivoFilial">Ano</label>
      <select id="carregaComboAnoByFilial" class="form-control select-controll-app" name="cadArquivoAno" required>
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
      <label for="cadArquivoFilial">Ano</label>
      <select id="carregaComboAnoByFilial" style="border: 1px solid #F00" class="form-control select-controll-app" name="cadArquivoAno" required>
        <option value="">Filial sem Ano ou não foi escolhido</option>
      </select>
    </div>
<?php
}
 ?>
