<div class="listProfessoresArea">
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
        foreach($professores as $professor) {
        ?>
        <tr class="<?php echo $professor->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $professor->CD_PROFESSOR;?></td>
            <td><?php echo $professor->NOME;?></td>
            <td class="text-center"><?php echo $professor->PRIVADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><?php echo $professor->ESTADO == '1' ? 'Sim' : 'Não';?></td>
            <td class="text-center"><a title="Editar Professor" href="<?php echo URL; ?>professor/editarProfessor/<?php echo $professor->CD_PROFESSOR;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear/Desbloquear Professor" href="<?php echo $professor->ESTADO == '1' ? URL.'professor/bloquearProfessor/'.$professor->CD_PROFESSOR : URL.'professor/desbloquearProfessor/'.$professor->CD_PROFESSOR;?>">
              <span class="glyphicon glyphicon-<?php echo $professor->ESTADO == '1' ? 'remove' : 'ok';?>"></span>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
