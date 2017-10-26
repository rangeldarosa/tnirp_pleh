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
                <a href="<?php echo URL;?>"><li class="<?php echo !isset($_GET['url']) || empty($_GET['url']) ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Dashboard</li></a>
                <a href="<?php echo URL;?>ano"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'ano') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Ano</li></a>
                <a href="<?php echo URL;?>arquivo"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'arquivo') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Arquivo</li></a>
                <a href="<?php echo URL;?>curso"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'curso') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Curso</li></a>
                <a href="<?php echo URL;?>filial"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'filial') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Filial</li></a>
                <a href="<?php echo URL;?>professor"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'professor') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Professor</li></a>
                <a href="<?php echo URL;?>instituicao"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'instituicao') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Instituição</li></a>

                <li data-toggle="collapse" data-target="#localizacao" class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'cidade') || ($_GET['url'] == 'estado') ? 'active' : 'collapsed'?>">
                  <a href="#"><i class="fa fa-gift fa-lg"></i> Localização <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu <?php echo isset($_GET['url']) && ($_GET['url'] == 'cidade') ? 'collapse in' : 'collapse'?>" id="localizacao">
                  <a href="<?php echo URL;?>cidade"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'cidade') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Cidade</li></a>
                </ul>
                <a href="<?php echo URL;?>disciplina"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'disciplina') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Disciplinas</li></a>
                <a href="<?php echo URL;?>usuario"><li class="<?php echo isset($_GET['url']) && ($_GET['url'] == 'usuario') ? 'active' : ''?>"><i class="fa fa-dashboard fa-lg"></i> Usuários</li></a>
            </ul>
     </div>
</nav>
