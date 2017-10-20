<div class="listCidadesArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th>Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="100">Ativo <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-pencil"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($cidades as $cidade) {
        ?>
        <tr>
            <td class="text-center"><?php echo $cidade->CD_CIDADE;?></td>
            <td><?php echo $cidade->NOME_CIDADE;?></td>
            <td class="text-center"><?php echo $cidade->ESTADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><a title="Editar Cidade" href="<?php echo URL; ?>cidade/editarCidade/<?php echo $cidade->CD_CIDADE;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Cidade" href="<?php echo $cidade->ESTADO == '1' ? URL.'cidade/bloquearCidade/'.$cidade->CD_CIDADE : URL.'cidade/desbloquearCidade/'.$cidade->CD_CIDADE;?>">
              <span class="glyphicon glyphicon-<?php echo $cidade->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
