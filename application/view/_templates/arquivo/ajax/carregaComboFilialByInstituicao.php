<?php
  if(isset($listaFilialInstituicao) && is_array($listaFilialInstituicao)) {
?>
    <div class="form-group">
      <label for="cadArquivoInstituicao">Filial</label>
      <select id="carregaComboFilialByInstituicao" class="form-control select-controll-app" name="cadArquivoFilial" required>
        <option value="">Selecione uma Filial</option>
    <?php
      foreach ($listaFilialInstituicao as $key) {
          echo "<option value='$key->CD_FILIAL'>".mb_strtoupper($key->NOME, 'UTF-8')."</option>";
      }
    ?>
    </select>
    </div>
<?php
  } else {
?>
    <div class="form-group">
      <label for="cadArquivoInstituicao">Filial</label>
      <select id="carregaComboFilialByInstituicao" style="border: 1px solid #F00" class="form-control select-controll-app" name="cadArquivoFilial" required>
        <option value="">Instituição sem Filial ou não foi escolhida</option>
      </select>
    </div>
<?php
}
 ?>
