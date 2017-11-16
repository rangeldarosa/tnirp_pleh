<div class="listUsuariosArea">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-vcenter table-list">
      <thead>
            <th class="text-center" width="70">Cod <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Login <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Filial <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center">Nível de Acesso <span class="glyphicon glyphicon-sort"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-pencil"></span></th>
            <th class="text-center" width="1"><span class="glyphicon glyphicon-remove"></span></th>
      </thead>
      <tbody>
        <?php
        foreach($usuarios as $usuario) {
          if ($usuario->NIVEL_DE_ACESSO == 0)
            $NIVEL_USER = 'Aluno';
          else if ($usuario->NIVEL_DE_ACESSO == 1)
            $NIVEL_USER = 'Caixa';
          else if ($usuario->NIVEL_DE_ACESSO == 2)
            $NIVEL_USER = 'Gerente';
          else
            $NIVEL_USER = 'Adminsitrador';

        ?>
        <tr class="<?php echo $usuario->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $usuario->CD_USUARIO;?></td>
            <td><?php echo $usuario->LOGIN;?></td>
            <td class="text-center"><?php echo ($usuario->NIVEL_DE_ACESSO != 3) ? mb_strtoupper($usuario->nome_filial , 'UTF-8') : 'TODAS';?></td>
            <td class="text-center"><?php echo $NIVEL_USER;?></td>
            <td class="text-center"><a title="Editar Usuário" href="<?php echo URL; ?>usuario/editarUsuario/<?php echo $usuario->CD_USUARIO;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear Usuário" href="<?php echo $usuario->ESTADO == 1 ? URL.'usuario/bloquearUsuario/'.$usuario->CD_USUARIO : URL.'usuario/desbloquearUsuario/'.$usuario->CD_USUARIO;?>">
                <span class="glyphicon glyphicon-<?php echo $usuario->ESTADO == 1 ? 'remove' : 'ok' ?>"><span/>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
