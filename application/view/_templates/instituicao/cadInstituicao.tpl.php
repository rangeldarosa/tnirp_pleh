<div class="cadInstituicaoArea">
  <form action="<?php echo !isset($instituicao) ? URL.'instituicao/salvarInstituicao' : '';?>" method="post">

    <div class="form-group">
      <label for="cadInstituicaoNome">Nome da Instituição</label>
      <input type="text" name="cadInstituiçãoNome" class="form-control input-controll-app" id="cadInstituiçãoNome" placeholder="Nome da Instituição" required maxlength= "255" value="<?php echo isset($instituicao) ? $instituicao->NOME_INSTITUICAO : ''; ?>">
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
      <a href="<?php echo URL;?>disciplina"><button type="button" class="btn btn-default btn-default-app">Casdastro de Disciplinas <i class="fa fa-arrow-right"></i></button></a>
    </div>

  </form>
</div>
