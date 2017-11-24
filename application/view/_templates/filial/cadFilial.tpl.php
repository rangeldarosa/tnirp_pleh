<div class="cadFilialArea">
  <form action="<?php echo !isset($filial) ? URL.'filial/salvarFilial' : '';?>" method="post">

    <div class="form-group">
      <label for="cadFilialNome">Nome da Filial</label>
      <input type="text" name="cadFilialNome" class="form-control input-controll-app" id="cadFilialNome" placeholder="Nome da Filial" required maxlength="255" value="<?php echo isset($filial) ? $filial->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadFilialValorPeB">Valor Preto/Branco</label>
      <input type="text" name="cadFilialTaxaImpressaoPretoEBranco" class="form-control input-controll-app price" id="cadFilialValorPeB" placeholder="Valor Preto/Branco" required maxlength="10" value="<?php echo isset($filial) ? $filial->TAXA_IMPRESSAO_PRETO_E_BRANCO : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadFilialValorColor">Valor Colorido</label>
      <input type="text" name="cadFilialTaxaImpressaoColorida" class="form-control input-controll-app price" id="cadFilialValorColor" placeholder="Valor Colorido" required maxlength="10" value="<?php echo isset($filial) ? $filial->TAXA_IMPRESSAO_COLORIDA : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadFilialStatus">Status</label>
      <select class="form-control select-controll-app" name="cadFilialStatus" id="cadFilialStatus" required>
        <option value="1" <?php echo isset($filial) && ($filial->ESTADO == 1) ? 'selected' : ''; ?>>Ativa</option>
        <option value="0" <?php echo isset($filial) && ($filial->ESTADO == 0) ? 'selected' : ''; ?>>Inativa</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cadFilialInstituicao">Instituição</label>
      <select class="form-control select-controll-app" name="cadFilialInstituicao" id="cadFilialInstituicao" required>
          <option value="">Selecione a Instituição</option>
          <?php
          foreach ($instituicoes as $instituicao):?>
            <option value="<?php echo $instituicao->CD_INSTITUICAO ?>" <?php echo isset($instituicao) && isset($filial) && ($filial->Instituicao_CD_INSTITUICAO == $instituicao->CD_INSTITUICAO) ? 'selected' : ''; ?>><?php echo mb_strtoupper($instituicao->NOME_INSTITUICAO, 'UTF-8')?></option>
          <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="cadFilialCidade">Cidade</label>
      <select class="form-control select-controll-app" name="cadFilialCidade" id="cadFilialCidade" required>
          <option value="">Selecione a Cidade</option>
          <?php
          foreach ($cidades as $cidade):?>
            <option value="<?php echo $cidade->CD_CIDADE ?>" <?php echo isset($cidade) &&  isset($filial) && ($filial->Cidade_CD_CIDADE == $cidade->CD_CIDADE) ? 'selected' : ''; ?>><?php echo mb_strtoupper($cidade->NOME_CIDADE, 'UTF-8')." - ".mb_strtoupper($cidade->ESTADO, 'UTF-8');?></option>
          <?php endforeach; ?>
      </select>
    </div>

    <hr/>
    <div class="form-group">
      <label for="cadFiliaisStatus">Anos</label>
      <select class="multi-select-app" multiple="multiple" name="cadFilialAno[]" required>
        <?php
        if(!empty($listaAno) && is_array($listaAno) && isset($listaAno)) {
          foreach($listaAno as $value) {
        ?>
          <option value="<?php echo $value->CD_ANO ?>" <?php echo $value->ESTADO == 0 ? 'disabled' : '' ?>><?php echo $value->NOME?> </option>
        <?php
          }
        }
        if(!empty($listaAnoRelacionado) && is_array($listaAnoRelacionado) && isset($listaAnoRelacionado)) {
          foreach($listaAnoRelacionado as $valueRel) {
            ?>
              <option value="<?php echo $valueRel->CD_ANO ?>" <?php echo $valueRel->ESTADO == 0 ? 'disabled' : '' ?> selected><?php echo $valueRel->NOME?> </option>
            <?php
          }
        }
        ?>
      </select>
    </div>

    <div class="text-center">
      <a href="<?php echo URL;?>ano"><input type="button" class="btn btn-default btn-default-app"  value="Casdastro de Ano" ></a>
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
      <a href="<?php echo URL;?>arquivo"><input type="button" class="btn btn-default btn-default-app"  value="Casdastro de Arquivo" ></a>
    </div>

  </form>
</div>
