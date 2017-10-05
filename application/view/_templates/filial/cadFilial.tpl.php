<?php
  if(isset($_POST['enviarDados']) && $_POST['enviarDados'] == 'Atualizar') {
    // CHAMADA METODO ATUALIZAR
  }
  if(isset($_POST['enviarDados']) && $_POST['enviarDados'] == 'Cadastrar') {
    // CHAMADA METODO CADASTRAR
  }
 ?>
 <div class="cadFilialArea">
  <form class="" action="" method="post">
    <div class="form-group">
      <label for="cadFilialNome">Nome da Filial</label>
      <input type="text" name="cadFilialNome" class="form-control input-controll-app" id="cadFilialNome" placeholder="Nome da Filial" required maxlength="60">
    </div>
    <div class="form-group">
      <label for="cadFilialEndereco">Endereço da Filial</label>
      <input type="text" name="cadFilialEndereco" class="form-control input-controll-app" id="cadFilialEndereco" placeholder="Endereço da Filial" required maxlength="60">
    </div>
    <div class="form-group">
      <label for="cadFilialEstado">Estado da Filial</label>
      <select class="form-control select-controll-app" name="cadFilialEstado" id="cadFilialEstado" required>
        <option value="">Selecione um Estado</option>
        <option value="2">SANTA CATARINA</option>
      </select>
    </div>
    <div class="form-group">
      <label for="cadFilialCidade">Cidade da Filial</label>
      <select class="form-control select-controll-app" name="cadFilialCidade" id="cadFilialCidade" required>
        <option value="">Selecione uma Cidade</option>
        <option value="12">TUBARÃO</option>
      </select>
    </div>
    <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="<?php echo $_GET['action'] == 'update' ? 'Atualizar' : 'Cadastrar';?>">
    <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
  </form>
<div>