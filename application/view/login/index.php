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