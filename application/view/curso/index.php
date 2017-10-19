<div class="container">
    <div class="cadCursoArea">
        <form action="<?php echo !isset($curso) ? URL.'curso/salvarCurso' : '';?>" method="post">
            <div class="form-group">
            <label for="cadCursoNome">Nome da Curso</label>
            <input type="text" name="cadCursoNome" class="form-control input-controll-app" id="cadCursoNome" placeholder="Nome da Curso" required maxlength="60" value="<?php echo isset($curso) ? $curso->NOME : ''; ?>">
            </div>
            <div class="form-group">
            <label for="cadCursoEstado">Estado da Curso</label>
            <input type="text" name="cadCursoEstado" class="form-control input-controll-app" id="cadCursoEstado" placeholder="Estado da Curso" required maxlength="60" value="<?php echo isset($curso) ? $curso->ESTADO : ''; ?>">
            </div>

            <div class="text-center">
            <input type="submit" class="btn btn-default btn-default-app" name="enviarDados" value="Enviar Dados">
            <input type="reset" class="btn btn-default btn-default-app" name="resetarDados" value="Resetar Dados">
            </div>
        </form>
    </div>
</div>