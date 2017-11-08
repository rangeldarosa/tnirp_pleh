<div class="cadInstituicaoArea">
  <form action="<?php echo !isset($instituicao) ? URL.'instituicao/salvarInstituicao' : '';?>" method="post">

    <div class="form-group">
      <label for="cadInstituicaoNome">Nome da Instituição</label>
      <input type="text" name="cadInstituiçãoNome" class="form-control input-controll-app" id="cadInstituiçãoNome" placeholder="Nome da Instituição" required maxlength= "255" value="<?php echo isset($instituicao) ? $instituicao->NOME_INSTITUICAO : ''; ?>">
    </div>

    <hr/>
    <div class="form-group">
      <label for="cadinstituicoesStatus">Filiais</label>
      <select class="multi-select-app" multiple="multiple" name="cadInstituicaoFilial[]" required>
        <?php
        if(!empty($listaFilial) && is_array($listaFilial) && isset($listaFilial)) {
          foreach($listaFilial as $value) {
        ?>
          <option value="<?php echo $value->CD_FILIAL ?>" <?php echo $value->ESTADO == 0 ? 'disabled' : '' ?>><?php echo $value->NOME?> </option>
        <?php
          }
        }
        if(!empty($listaFilialRelacionada) && is_array($listaFilialRelacionada) && isset($listaFilialRelacionada)) {
          foreach($listaFilialRelacionada as $valueRel) {
            ?>
              <option value="<?php echo $valueRel->CD_FILIAL ?>" <?php echo $valueRel->ESTADO == 0 ? 'disabled' : '' ?> selected><?php echo $valueRel->NOME?> </option>
            <?php
          }
        }
        ?>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
