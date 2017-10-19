<link href="<?php echo URL; ?>css/menuAdmin.css" rel="stylesheet">
<nav class="nav-side-menu">
    <button type="button" data-target="#menu-content" data-toggle="collapse" class="navbar-toggle buttom-nav-lateral">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
        <div class="menu-list">
              <div class="brand">
                <?php echo !$isMenuSuperior ? '<a style="width:100%;" href="'.URL.'" class="navbar-brand text-center"><img style="margin: 0 auto; margin-top: 10px;" class="text-center" src="'.URL.'img/logoHD.png" height="45px"/></a><br><br>' : 'Menu Administrador'?>
                </div>
            <ul id="menu-content" class="menu-content collapse out">
                <li><a href="<?php echo URL;?>"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a></li>
                <li><a href="<?php echo URL;?>professor"><i class="fa fa-dashboard fa-lg"></i> Professores</a></li>
            </ul>
     </div>
</nav>
