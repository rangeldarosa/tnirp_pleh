<link href="<?php echo URL; ?>css/menuAdmin.css" rel="stylesheet">
<div class="nav-side-menu">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
              <div class="brand">
                <?php echo !$isMenuSuperior ? '<a style="width:100%;" href="'.URL.'" class="navbar-brand text-center"><img style="margin: 0 auto; margin-top: 10px;" class="text-center" src="'.URL.'img/logoHD.png" height="45px"/></a><br><br>' : 'Menu Administrador'?>
                </div>
            <ul id="menu-content" class="menu-content collapse out">
                <li><a href="<?php echo URL;?>"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a></li>
                <li><a href="<?php echo URL;?>professor"><i class="fa fa-dashboard fa-lg"></i> Professores</a></li>
            </ul>
     </div>
</div>
