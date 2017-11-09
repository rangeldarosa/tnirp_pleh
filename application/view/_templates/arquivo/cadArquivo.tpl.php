<div class="cadArquivoArea">
  <form action="<?php echo !isset($arquivo) ? URL.'arquivo/salvarArquivo' : '';?>" method="post">

    <div class="form-group">
      <label for="cadArquivoNome">Nome do Arquivo</label>
      <input type="text" name="cadArquivoNome" class="form-control input-controll-app" id="cadArquivoNome" placeholder="Nome do Arquivo" required maxlength="255" value="<?php echo isset($arquivo) ? $arquivo->NOME : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoValorPeB">Valor Preto/Branco</label>
      <input type="text" name="cadArquivoValorPeB" class="form-control input-controll-app price" id="cadArquivoValorPeB" placeholder="Valor P/B" required maxlength="10" value="<?php echo isset($arquivo) ? $arquivo->VALOR_PRETO_E_BRANCO : ''; ?>">

    </div>
    <div class="form-group">
      <label for="cadArquivoValorColor">Valor Colorido</label>
      <input type="text" name="cadArquivoValorColor" class="form-control input-controll-app price" id="cadArquivoValorColor" placeholder="Valor Colorido" required maxlength="10" value="<?php echo isset($arquivo) ? $arquivo->VALOR_COLORIDO : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoPaginas">Número de Páginas</label>
      <input type="text" name="cadArquivoPaginas" class="form-control input-controll-app" id="cadArquivoPaginas" placeholder="Número de Páginas" required maxlength="10" value="<?php echo isset($arquivo) ? $arquivo->PAGINAS : ''; ?>">
    </div>

    <div class="form-group">
      <label for="cadArquivoFile"><i class="fa fa-lg fa-file-pdf-o" aria-hidden="true"></i> Arquivo</label>
      <input type="file" name="cadArquivoFile" class="form-control input-file-app" id="cadArquivoFile">
    </div>

    <div class="form-group">
      <label for="cadArquivoArqPrivado">Privado</label>
      <select class="form-control select-controll-app" name="cadArquivoArqPrivado" id="cadArquivoArqPrivado" required>
        <option value="1" <?php echo isset($arquivo) && ($arquivo->ARQUIVO_PRIVADO == 1) ? 'selected' : ''; ?>>Privado</option>
        <option value="0" <?php echo isset($arquivo) && ($arquivo->ARQUIVO_PRIVADO == 0) ? 'selected' : ''; ?>>Público</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cadArquivoPrivado">Status</label>
      <select class="form-control select-controll-app" name="cadArquivoEstado" id="cadArquivoEstado" required>
        <option value="1" <?php echo isset($arquivo) && ($arquivo->ESTADO == 1) ? 'selected' : ''; ?>>Ativo</option>
        <option value="0" <?php echo isset($arquivo) && ($arquivo->ESTADO == 0) ? 'selected' : ''; ?>>Inativo</option>
      </select>
    </div>

      <hr>
    <div class="form-group">
      <label for="cadArquivoInstituicao">Instituição</label>
      <select id="cadArquivoInstituicao" onchange="appConfig.ajaxDynamicSimpleCombo('filial', 'buscarFilialPorInsituicaoCombo', '#loadComboFilial', 'limparComboFilialPorInstituicao', this.value)" class="select-controll-app" name="cadArquivoInstituicao" required>
          <<option value="">Selecione uma Instituição</option>
          <?php
            if (is_array($listarInstituicoesCombo)) {
              foreach ($listarInstituicoesCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_INSTITUICAO ?>" <?php echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_INSTITUICAO, 'UTF-8')?></option>
                <?php
              }
            }
          ?>
      </select>
    </div>

    <!-- CAMPO SELECT É CARREGADO ATRAVEZ DO AJAX DENTRO DA DIV-->
    <div id="loadComboFilial"></div>

    <div class="form-group">
      <label for="cadArquivoFilial">Filial</label>
      <select id="cadArquivoFilial" onchange="appConfig.ajaxDynamicSimpleCombo('ano', 'buscarAnoPorFilialCombo', '#loadComboAno', 'limparComboAnoPorFilialEInstituicao', this.value)" class="select-controll-app" name="cadArquivoFilial" required>
          <<option value="">Selecione uma Filial</option>
          <?php
            if (is_array($listarFiliaisCombo)) {
              foreach ($listarFiliaisCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_FILIAL ?>" <?php echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_FILIAL, 'UTF-8')?></option>
                <?php
              }
            }
          ?>
      </select>
    </div>

    <div id="loadComboAno"></div>

    <div class="form-group">
      <label for="cadArquivoAno">Ano</label>
      <select id="cadArquivoAno" onchange="appConfig.ajaxDynamicSimpleCombo('curso', 'buscarCursoPorAnoCombo', '#loadComboCurso', 'limparComboCursoPorAno', this.value)" class="select-controll-app" name="cadArquivoAno" required>
          <<option value="">Selecione um Ano</option>
          <?php
            if (is_array($listarAnosCombo)) {
              foreach ($listarAnosCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_ANO ?>" <?php echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_ANO, 'UTF-8')?></option>
                <?php
              }
            }
          ?>
      </select>
    </div>

    <div id="loadComboCurso"></div>

    <div class="form-group">
      <label for="cadArquivoCurso">Curso</label>
      <select id="cadArquivoCurso" onchange="appConfig.ajaxDynamicSimpleCombo('professor', 'buscarProfessorPorCursoCombo', '#loadComboCurso', 'limparComboProfessorPorCurso', this.value)" class="select-controll-app" name="cadArquivoCurso" required>
          <<option value="">Selecione um Curso</option>
          <?php
            if (is_array($listarCursosCombo)) {
              foreach ($listarCursosCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_CURSO ?>" <?php echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_CURSO, 'UTF-8')?></option>
                <?php
              }
            }
          ?>
      </select>
    </div>

    <div id="loadComboProfessor"></div>

    <div class="form-group">
      <label for="cadArquivoProfessor">Professor</label>
      <select id="cadArquivoProfessor" onchange="appConfig.ajaxDynamicSimpleCombo('disciplina', 'buscarDisciplinaPorProfessorCombo', '#loadComboProfessor', 'limparComboDisciplinaPorProfessor', this.value)" class="select-controll-app" name="cadArquivoProfessor" required>
          <<option value="">Selecione um Professor</option>
          <?php
            if (is_array($listarProfessoresCombo)) {
              foreach ($listarProfessoresCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_PROFESSOR ?>" <?php echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_PROFESSOR, 'UTF-8')?></option>
                <?php
              }
            }
          ?>
      </select>
    </div>

    <div id="loadComboDisciplina"></div>

    <div class="form-group">
      <label for="cadArquivoDisciplina">Disciplina</label>
      <select id="cadArquivoDisciplina"  class="select-controll-app" name="cadArquivoDisciplina" required>
          <<option value="">Selecione uma Disciplina</option>
          <?php
            if (is_array($listarDisciplinasCombo)) {
              foreach ($listarDisciplinasCombo as $key) {
                ?>
                <option value="<?php echo $key->CD_DISCIPLINA ?>" <?php echo $key->ESTADO==0 ? "disabled" : "" ?>><?php echo mb_strtoupper($key->NOME_DISCIPLINA, 'UTF-8')?></option>
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
