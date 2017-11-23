<div class="cadInstituicaoArea">
  <form action="<?php echo !isset($instituicao) ? URL.'instituicao/salvarInstituicao' : '';?>" method="post">

    <div class="form-group">
      <label for="cadInstituicaoNome">Nome da Instituição</label>
      <input type="text" name="cadInstituiçãoNome" class="form-control input-controll-app" id="cadInstituiçãoNome" placeholder="Nome da Instituição" required maxlength= "255" value="<?php echo isset($instituicao) ? $instituicao->NOME_INSTITUICAO : ''; ?>">
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
      <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
      <a href="<?php echo URL;?>disciplina"><input type="button" class="btn btn-default btn-default-app fa fa-arrow-left"  value="Casdastro de Disciplinas" ></a>
    </div>

  </form>
</div>
