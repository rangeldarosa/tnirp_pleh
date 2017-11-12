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
        ?>
        <tr class="<?php echo $usuario->ESTADO == 0 ? 'danger' : ''?>">
            <td class="text-center"><?php echo $usuario->CD_USUARIO;?></td>
            <td><?php echo $usuario->LOGIN;?></td>
            <td><?php echo $usuario->FILIAL;?></td>
            <td class="text-center"><?php echo $usuario->NIVEL_DE_ACESSO;?></td>
            <td class="text-center"><a title="Editar Usuário" href="<?php echo URL; ?>usuario/editarUsuario/<?php echo $usuario->CD_USUARIO;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td class="text-center"><a title="Bloquear Usuário" href="<?php echo  URL.'usuario/bloquearUsuario/'.$usuario->CD_USUARIO;?>">
                <span class="glyphicon glyphicon-remove"><span/>
            </a></td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
