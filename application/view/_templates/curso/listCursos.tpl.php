<div class="listCursosArea">
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
        foreach($cursos as $curso) {
        ?>
        <tr class="<?php echo $curso->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $curso->CD_CURSO;?></td>
            <td><?php echo $curso->NOME;?></td>
            <td><?php echo $curso->ESTADO == 0 ? 'Desativado' : 'Ativo';?></td>
            <td class="text-center"><a title="Editar Curso" href="<?php echo URL; ?>curso/editarCurso/<?php echo $curso->CD_CURSO;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Curso" href="<?php echo $curso->ESTADO == '1' ? URL.'curso/bloquearCurso/'.$curso->CD_CURSO : URL.'curso/desbloquearCurso/'.$curso->CD_CURSO;?>">
              <span class="glyphicon glyphicon-<?php echo $curso->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
