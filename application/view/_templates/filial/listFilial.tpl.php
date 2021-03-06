<div class="listFiliaisArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="80">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th >Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Valor Colorido <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Valor Preto/Branco <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Instituição <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Cidade <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Estado <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-pencil"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($filiais as $filial) {
        ?>
        <tr class="<?php echo $filial->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $filial->CD_FILIAL;?></td>
            <td><?php echo mb_strtoupper($filial->NOME, 'UTF-8');?></td>
            <td class="text-center"><?php echo $filial->TAXA_IMPRESSAO_COLORIDA;?></td>
            <td class="text-center"><?php echo $filial->TAXA_IMPRESSAO_PRETO_E_BRANCO;?></td>
            <td class="text-center"><?php echo mb_strtoupper($filial->NOME_INSTITUICAO, 'UTF-8');?></td>
            <td class="text-center"><?php echo mb_strtoupper($filial->NOME_CIDADE, 'UTF-8');?></td>
            <td class="text-center"><?php echo mb_strtoupper($filial->nmestado, 'UTF-8');?></td>
            <td class="text-center"><a title="Editar Filial" href="<?php echo URL; ?>filial/editarFilial/<?php echo $filial->CD_FILIAL;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Filial" href="<?php echo $filial->ESTADO == '1' ? URL.'filial/bloquearFilial/'.$filial->CD_FILIAL : URL.'filial/desbloquearFilial/'.$filial->CD_FILIAL;?>">
              <span class="glyphicon glyphicon-<?php echo $filial->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
