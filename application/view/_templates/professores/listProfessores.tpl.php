<div class="listProfessoresArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th>Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th>Nome <span class="glyphicon glyphicon-sort"></span></th>
            <th>Privado <span class="glyphicon glyphicon-sort"></span></th>
            <th>Ativo <span class="glyphicon glyphicon-sort"></span></th>
            <th><span class="glyphicon glyphicon-pencil"></span></th>
            <th><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($professores as $professor) {
        ?>
        <tr class="<?php echo $professor->ESTADO == 0 ? 'danger' : ''?>">
            <td><?php echo $professor->CD_PROFESSOR;?></td>
            <td><?php echo $professor->NOME;?></td>
            <td><?php echo $professor->PRIVADO == '1' ? 'Sim' : 'Não';?></td>
            <td><?php echo $professor->ESTADO == '1' ? 'Sim' : 'Não';?></td>
            <td><a title="Editar Professor" href="<?php echo URL; ?>professor/editarProfessor/<?php echo $professor->CD_PROFESSOR;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a title="Bloquear/Desbloquear Professor" href="<?php echo $professor->ESTADO == '1' ? URL.'professor/bloquearProfessor/'.$professor->CD_PROFESSOR : URL.'professor/desbloquearProfessor/'.$professor->CD_PROFESSOR;?>">
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
