<div class="listDisciplinasArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th>Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="100">Privado <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="80">Ativo <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-pencil"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($disciplinas as $disciplina) {
        ?>
        <tr class="<?php echo $disciplina->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $disciplina->CD_DISCIPLINA;?></td>
            <td><?php echo $disciplina->NOME;?></td>
            <td class="text-center"><?php echo $disciplina->PRIVADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><?php echo $disciplina->ESTADO == '1' ? 'Sim' : 'Não';?></td>
            <td><a title="Editar Disciplina" href="<?php echo URL; ?>disciplina/editarDisciplina/<?php echo $disciplina->CD_DISCIPLINA;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a title="Bloquear/Desbloquear Disciplina" href="<?php echo $disciplina->ESTADO == '1' ? URL.'disciplina/bloquearDisciplina/'.$disciplina->CD_DISCIPLINA : URL.'disciplina/desbloquearDisciplina/'.$disciplina->CD_DISCIPLINA;?>">
              <span class="glyphicon glyphicon-<?php echo $disciplina->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
