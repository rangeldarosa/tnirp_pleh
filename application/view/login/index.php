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
								<label for="login" id="loginl">Login:</label> <br/>
								<input class="form-control" type="text" name="login" id="loginh"/> <br/>

								<label for="senha" id="senhal">Senha:</label> <br/>
								<input class="form-control" type="password" name="senha" id="senha"/> <br/>

								<div class="pull-right">
									<input type="submit" class="btn btn-primary btn-submit-app" value="Fazer Login">
								</div>
								<div class="clearfix"></div>
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
