<div class="listAnosArea">
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
        foreach($anos as $ano) {
        ?>
        <tr class="<?php echo $ano->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $ano->CD_ANO;?></td>
            <td><?php echo $ano->NOME;?></td>
			      <td class="text-center"><?php echo $ano->ESTADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><a title="Editar Ano" href="<?php echo URL; ?>ano/editarAno/<?php echo $ano->CD_ANO;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Ano" href="<?php echo $ano->ESTADO == '1' ? URL.'ano/bloquearAno/'.$ano->CD_ANO : URL.'ano/desbloquearAno/'.$ano->CD_ANO;?>">
              <span class="glyphicon glyphicon-<?php echo $ano->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
