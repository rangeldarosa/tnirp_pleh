<link href="<?php echo URL; ?>css/menuSuperiorAdmin.css" rel="stylesheet">
<nav class="navbar navbar-default noPaddingMenu">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?php echo URL;?>" class="navbar-brand"><img src="<?php echo URL ?>img/logoHD.png" height="30px"/></a>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Messages</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo URL?>login/logOut">Sair</a></li>
        </ul>
    </div>
</nav>
