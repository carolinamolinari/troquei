<!DOCTYPE HTML>

<html>
	<head>
		<title>Troquei - Entrar</title>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Responsive HTML5 Website landing Page for Developers">
		<meta name="author" content="3rd Wave Media">
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>	
		<link rel="stylesheet" href="assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
		<link id="theme-style" rel="stylesheet" href="assetsPerfil/css/styles.css">

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
		<header id="header" style="height: 90px; font-family: Montserrat;">
			<a href='../index.php'><img src='../images/troquei.png' height='85px' width = '145px'></a>	
			
			<nav class="right">
				
				<a href='../cliente/criarConta.php' class='button alt' style='margin-top: 27px;'>Criar conta</a>
			</nav>
		</header>
				
		<!-- Cadastro -->
		<div class="cadastro" style="width: 500px; height: 1000px; margin: auto;">
			<?php
				
				if(isset($_GET['error'])){
					print "<span style='color:red; font-weight: bold; font-size: 20px;'>Erro ao efetuar o login! Senha ou usuários incorretos</span>";
				}
			
			?>
			<form method="post" action="confirmalogin.php" style="margin-top: 10px;">
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Email:</label>
				<input type="email" name="emailCliente" />
				<br>
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Senha</label>
				<input type="password" name="senhaCliente" />
				<br>
				<button type="submit" id="botaoEntrar" class="button fit">
					Entrar
				</button>
			</form>
		</div>

		<!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.scrolly.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>

	</body>
</html>