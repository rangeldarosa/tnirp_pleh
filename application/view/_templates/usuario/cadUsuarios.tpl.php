<div class="cadUsuarioArea">
  <form action="<?php echo !isset($usuario) ? URL.'usuario/salvarUsuario' : '';?>" method="post">

    <div class="form-group">
      <label for="cadUsuarioLogin">Login do Usuário</label>
      <input type="text" name="cadUsuarioLogin" class="form-control input-controll-app" id="cadUsuarioLogin" placeholder="Login do Usuário" required maxlength="255" value="<?php echo isset($usuario) ? $usuario->LOGIN : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadUsuarioSenha">Senha do Usuário</label>
      <input type="password" name="cadUsuarioSenha" class="form-control input-controll-app" id="cadUsuarioSenha" placeholder="Senha do Usuário" required maxlength="255" value="<?php echo isset($usuario) ? $usuario->SENHA : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadUsuarioFilial">Filial de Acesso</label>
      <select id="cadUsuarioFilial" class="select-controll-app" name="cadUsuarioFilial" required>
    <?php
      if($_SESSION['usuario']->nivel_de_acesso == 3) {
    ?>
      <option value="">Selecione uma Filial</option>
    <?php
        foreach ($filiais as $key) { ?>
          <option value="<?php echo $key->CD_FILIAL?>" <?php echo isset($usuario) && ($usuario->FK_CD_FILIAL == $key->CD_FILIAL) ? 'selected' : ''?>><?php echo mb_strtoupper($key->NOME, 'UTF-8')?></option>
    <?php
        }
      } else {
        ?>
        <option value="<?php echo $_SESSION['usuario']->fk_cd_filial; ?>"><?php echo $_SESSION['usuario']->nome_filial;?></option>
        <?php
      }
     ?>
    </select>
    </div>

    <div class="form-group">
      <label for="cadUsuarioNivelAcesso">Nivel de Acesso</label>
      <select class="form-control select-controll-app" name="cadUsuarioNivelAcesso" id="cadUsuarioNivelAcesso" required>
        <option value="0" <?php echo isset($usuario) && ($usuario->NIVEL_DE_ACESSO == 0) ? 'selected' : ''; ?>>Aluno</option>
        <option value="1" <?php echo isset($usuario) && ($usuario->NIVEL_DE_ACESSO == 1) ? 'selected' : ''; ?>>Caixa</option>
        <?php if($_SESSION['usuario']->nivel_de_acesso == 3) { ?>
          <option value="2" <?php echo isset($usuario) && ($usuario->NIVEL_DE_ACESSO == 2) ? 'selected' : ''; ?>>Gerente</option>
          <option value="3" <?php echo isset($usuario) && ($usuario->NIVEL_DE_ACESSO == 3) ? 'selected' : ''; ?>>Administrador</option>
        <?php } ?>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" class="btn btn-default btn-default-app btn-success" name="enviarDados" value="Enviar Dados">
    </div>

  </form>
</div>
