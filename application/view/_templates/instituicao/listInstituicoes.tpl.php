<div class="listCursosArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th>Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-pencil"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($instituicoes as $instituicao) {
        ?>
        <tr class="<?php echo $instituicao->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $instituicao->CD_INSTITUICAO;?></td>
            <td><?php echo mb_strtoupper($instituicao->NOME_INSTITUICAO, 'UTF-8');?></td>
            <td class="text-center"><a title="Editar Instituição" href="<?php echo URL; ?>instituicao/editarInstituicao/<?php echo $instituicao->CD_INSTITUICAO;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Instituição" href="<?php echo $instituicao->ESTADO == '1' ? URL.'instituicao/bloquearInstituicao/'.$instituicao->CD_INSTITUICAO : URL.'instituicao/desbloquearInstituicao/'.$instituicao->CD_INSTITUICAO;?>">
              <span class="glyphicon glyphicon-<?php echo $instituicao->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
