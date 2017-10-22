<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HD Print</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="<?php echo URL; ?>imagens/icon.ico">

	<script type="text/javascript" src="<?php echo URL; ?>lib/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?php echo URL; ?>lib/bootstrap/dist/js/bootstrap.min.js"></script>

	<link href="<?php echo URL; ?>lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
	<link href="<?php echo URL; ?>lib/styles/main.css" rel="stylesheet">

  <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
	<div class="loginArea">
		<div class="container">
			<div class="col-lg-4 col-sm-6 col-xs-10">
				<div class="row">
					<div class="panel-centered">
						<div class="panel-centered-title">
							<img src="<?php echo URL;?>/img/logoHD.png" class="img-responsive">
						</div>
						<div class="panel-centered-body">
							<form method="post" action="<?php echo URL; ?>login/validarLogin" id="acesso"/>
                <?php
                  include APP . 'view/_templates/alerts/alerts.tpl.php';
                ?>

                <div style="margin-bottom: 5px;" class="input-group margin-bottom-sm">
                  <span class="input-group-addon" for="login"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                  <input class="form-control" type="text" name="login" id="login" placeholder="Digite o Login"/> <br/>
                </div>

                <div style="margin-bottom: 5px;"class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
		              <input class="form-control" type="password" name="senha" id="senha" placeholder="Digite a Senha"/> <br/>
                </div>
                  <button type="submit" class="btn btn-primary btn-submit-app btn-block">Fazer Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>              
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<script>
			var url = "<?php echo URL; ?>";
	</script>
</body>
</html>
