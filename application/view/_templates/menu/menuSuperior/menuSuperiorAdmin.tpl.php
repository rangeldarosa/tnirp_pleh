<link href="<?php echo URL; ?>css/menuSuperiorAdmin.css" rel="stylesheet">
<nav class="navbar navbar-default noPaddingMenu">

    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?php echo URL;?>" class="navbar-brand"><img src="<?php echo URL ?>img/logoHD.png" height="30px"/></a>
    </div>

    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <!-- <li class="<?php /*echo !isset($_GET['url']) || empty($_GET['url']) ? 'active' : ''?>"><a href="<?php echo URL*/?>">Home</a></li> -->
            <li class="<?php echo !empty($_GET['url']) && $_GET['url']=="pastas" ? 'active' : ''?>"><a href="<?php echo URL?>pastas">Pastas</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo URL?>login/logOut">Sair</a></li>
        </ul>
    </div>
</nav>
