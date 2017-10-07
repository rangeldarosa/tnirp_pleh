<div class="listProfessoresArea">
  <div class="table-responsive">
    <table class="table table-responsive table-striped">
      <thead>
            <th>Cod</th>
            <th>Nome</th>
            <th>Privado</th>
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
            <td><a title="Editar Professor" href="<?php echo URL; ?>professor/editarProfessor/<?php echo $professor->CD_PROFESSOR;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a title="Bloquear/Desbloquear Professor" href="<?php echo URL; ?>professor/bloquearProfessor/<?php echo $professor->CD_PROFESSOR;?>">
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
