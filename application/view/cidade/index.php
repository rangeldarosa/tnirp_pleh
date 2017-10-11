<div class="container">
    <div class="cadCidadeArea">
        <form action="<?php echo !isset($cidade) ? URL.'cidade/salvarCidade' : '';?>" method="post">
            <div class="form-group">
            <label for="cadCidadeNome">Nome da Cidade</label>
            <input type="text" name="cadCidadeNome" class="form-control input-controll-app" id="cadCidadeNome" placeholder="Nome da Cidade" required maxlength="60" value="<?php echo isset($cidade) ? $cidade->NOME : ''; ?>">
            </div>
            <div class="form-group">
            <label for="cadCidadeEstado">Estado da Cidade</label>
            <input type="text" name="cadCidadeEstado" class="form-control input-controll-app" id="cadCidadeEstado" placeholder="Estado da Cidade" required maxlength="60" value="<?php echo isset($cidade) ? $cidade->ESTADO : ''; ?>">
            </div>

            <div class="text-center">
            <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
            <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
            </div>
        </form>
    </div>
</div>