<div class="listArquivosArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th>Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Valor preto e branco <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Valor colorido <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Páginas <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Caminho <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="100">Arquivo privado <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="70">Privado <span class="glyphicon glyphicon-sort"></span></th>
            <th><span class="glyphicon glyphicon-pencil"></span></th>
            <th><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($arquivos as $arquivo) {
        ?>
        <tr>
            <td class="text-center"><?php echo $arquivo->CD_ARQUIVO;?></td>
            <td><?php echo $arquivo->NOME;?></td>
            <td class="text-center"><?php echo $arquivo->VALOR_PRETO_E_BRANCO;?></td>
            <td class="text-center"><?php echo $arquivo->VALOR_COLORIDO;?></td>
            <td class="text-center"><?php echo $arquivo->PAGINAS;?></td>
            <td class="text-center"><?php echo $arquivo->CAMINHO_PARA_O_ARQUIVO;?></td>
            <td class="text-center"><?php echo $arquivo->ARQUIVO_PRIVADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><?php echo $arquivo->ESTADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><a title="Editar Arquivo" href="<?php echo URL; ?>arquivo/editarArquivo/<?php echo $arquivo->CD_ARQUIVO;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Arquivo" href="<?php echo $arquivo->ESTADO == '1' ? URL.'arquivo/bloquearArquivo/'.$arquivo->CD_ARQUIVO : URL.'arquivo/desbloquearArquivo/'.$arquivo->CD_ARQUIVO;?>">
				          <span class="glyphicon glyphicon-<?php echo $arquivo->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
