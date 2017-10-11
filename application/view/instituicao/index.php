<div class="container">
    <div class="cadCidadeArea">
        <form action="<?php echo !isset($instituicao) ? URL.'instituicao/salvarInstituicao' : '';?>" method="post">
            <div class="form-group">
            <label for="cadCidadeNome">Nome da Cidade</label>
            <input type="text" name="cadInstituicaoNome" class="form-control input-controll-app" id="cadInstituicaoNome" placeholder="Nome da Instituicao" required maxlength="60" value="<?php echo isset($cidade) ? $cidade->NOME : ''; ?>">
            </div>
            <div class="text-center">
            <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
            <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
            </div>
        </form>
    </div>
</div>