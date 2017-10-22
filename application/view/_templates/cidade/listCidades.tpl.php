<div class="listCidadesArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th>Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th>Estado <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-pencil"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($cidades as $cidade) {
        ?>
        <tr>
            <td class="text-center"><?php echo $cidade->CD_CIDADE;?></td>
            <td><?php echo mb_strtoupper($cidade->NOME_CIDADE, 'UTF-8');?></td>
            <td><?php echo mb_strtoupper($cidade->ESTADO, 'UTF-8'); ?></td>
            <td class="text-center"><a title="Editar Cidade" href="<?php echo URL; ?>cidade/editarCidade/<?php echo $cidade->CD_CIDADE;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
