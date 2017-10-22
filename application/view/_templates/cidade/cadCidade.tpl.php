<div class="cadCidadeArea">
  <form action="<?php echo !isset($cidade) ? URL.'cidade/salvarCidade' : '';?>" method="post">

    <div class="form-group">
      <label for="cadCidadeNome">Nome da Cidade</label>
      <input type="text" name="cadCidadeNome" class="form-control input-controll-app" id="cadCidadeNome" placeholder="Nome da Cidade" required maxlength= "255" value="<?php echo isset($cidade) ? $cidade->NOME_CIDADE : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadCidadeEstado">Estado</label>
      <select class="form-control select-controll-app" name="cadCidadeEstado" id="cadCidadeEstado" required>
        <option value="AC" <?php echo isset($cidade) && ($cidade->ESTADO == "AC") ? 'SELECTED' : ''; ?>>AC</option>
      	<option value="AL" <?php echo isset($cidade) && ($cidade->ESTADO == "AL") ? 'SELECTED' : ''; ?>>AC</option>
      	<option value="AP" <?php echo isset($cidade) && ($cidade->ESTADO == "AP") ? 'SELECTED' : ''; ?>>AP</option>
      	<option value="AM" <?php echo isset($cidade) && ($cidade->ESTADO == "AM") ? 'SELECTED' : ''; ?>>AM</option>
      	<option value="BA" <?php echo isset($cidade) && ($cidade->ESTADO == "BA") ? 'SELECTED' : ''; ?>>BA</option>
      	<option value="CE" <?php echo isset($cidade) && ($cidade->ESTADO == "CE") ? 'SELECTED' : ''; ?>>CE</option>
      	<option value="DF" <?php echo isset($cidade) && ($cidade->ESTADO == "DF") ? 'SELECTED' : ''; ?>>DF</option>
      	<option value="ES" <?php echo isset($cidade) && ($cidade->ESTADO == "ES") ? 'SELECTED' : ''; ?>>ES</option>
      	<option value="GO" <?php echo isset($cidade) && ($cidade->ESTADO == "GO") ? 'SELECTED' : ''; ?>>GO</option>
      	<option value="MA" <?php echo isset($cidade) && ($cidade->ESTADO == "MA") ? 'SELECTED' : ''; ?>>MA</option>
      	<option value="MT" <?php echo isset($cidade) && ($cidade->ESTADO == "MT") ? 'SELECTED' : ''; ?>>MT</option>
      	<option value="MS" <?php echo isset($cidade) && ($cidade->ESTADO == "MS") ? 'SELECTED' : ''; ?>>MS</option>
      	<option value="MG" <?php echo isset($cidade) && ($cidade->ESTADO == "MG") ? 'SELECTED' : ''; ?>>MG</option>
      	<option value="PA" <?php echo isset($cidade) && ($cidade->ESTADO == "PA") ? 'SELECTED' : ''; ?>>PA</option>
      	<option value="PB" <?php echo isset($cidade) && ($cidade->ESTADO == "PB") ? 'SELECTED' : ''; ?>>PB</option>
      	<option value="PR" <?php echo isset($cidade) && ($cidade->ESTADO == "PR") ? 'SELECTED' : ''; ?>>PR</option>
      	<option value="PE" <?php echo isset($cidade) && ($cidade->ESTADO == "PE") ? 'SELECTED' : ''; ?>>PE</option>
      	<option value="PI" <?php echo isset($cidade) && ($cidade->ESTADO == "PI") ? 'SELECTED' : ''; ?>>PI</option>
      	<option value="RJ" <?php echo isset($cidade) && ($cidade->ESTADO == "RJ") ? 'SELECTED' : ''; ?>>RJ</option>
      	<option value="RN" <?php echo isset($cidade) && ($cidade->ESTADO == "RN") ? 'SELECTED' : ''; ?>>RN</option>
      	<option value="RS" <?php echo isset($cidade) && ($cidade->ESTADO == "RS") ? 'SELECTED' : ''; ?>>RS</option>
      	<option value="RO" <?php echo isset($cidade) && ($cidade->ESTADO == "RO") ? 'SELECTED' : ''; ?>>RO</option>
      	<option value="RR" <?php echo isset($cidade) && ($cidade->ESTADO == "RR") ? 'SELECTED' : ''; ?>>RR</option>
      	<option value="SC" <?php echo isset($cidade) && ($cidade->ESTADO == "SC") || empty($cidade) ? 'SELECTED' : ''; ?>>SC</option>
      	<option value="SP" <?php echo isset($cidade) && ($cidade->ESTADO == "SP") ? 'SELECTED' : ''; ?>>SP</option>
      	<option value="SE" <?php echo isset($cidade) && ($cidade->ESTADO == "SE") ? 'SELECTED' : ''; ?>>SE</option>
      	<option value="TO" <?php echo isset($cidade) && ($cidade->ESTADO == "TO") ? 'SELECTED' : ''; ?>>TO</option>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
    </div>

  </form>
</div>
