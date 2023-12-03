<?php
// Inicia a sessão.
session_start();

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Troquei - Sobre Nós</title>

		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Responsive HTML5 Website landing Page for Developers">
		<meta name="author" content="3rd Wave Media">
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>	
		<link rel="stylesheet" href="cliente/assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="cliente/assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
		<link id="theme-style" rel="stylesheet" href="cliente/assetsPerfil/css/styles.css">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body>

		<?php
			require_once ("header.php");
			require_once("bd.php");
		
		?>
		
					
		<!-- Banner -->
		<section id="banner" style="margin-top: auto; height: 1200px;">
			<div class="content" style="color: black; margin-top: -150px; text-align: center; font-size: 12px; width:1100px; margin-left: 250px;">
			    
				<h1>Sobre o Troquei</h1>
				<p>Somos um site sem fins lucrativos. 
				<p>Reduzir o impacto do consumo no meio-ambiente, gerar menos lixo e ressignificar objetos antigos: esses são nossos maiores objetivos.	<br>
				<p>Somos motivados pelo ODS 11, que trata de cidades e comunidades sustentáveis. 
				<p>Fomentamos o consumo consciênte, permitindo que os usuários troquem seus objetos inutilizados, em bom estado, por outros objetos que sejam mais úteis. 
				<br><br>
				<h1>Como sugiu</h1>
				<p>O Troquei foi fundado graças a um projeto de faculdade, proposto pelo professor Thiago Luis Lopes Siqueira, na disciplina de Projeto Integrado. Depois de muita pesquisa a respeito do segmento e também a respeito dos ODS, a fundadora Carolina Garcia Molinari começou o desenvolvimento e fundou o site utilizando as tecnologias: HTML, CSS, PHP, JavaScript e Mysql.
				<br><br>
				<h1>Equipe</h1>
				<p>O Troquei além de desenvolvido, é também gerenciado por Carolina Garcia Molinari, que é responsável por manter seu funcionamento, corrigir quaiquer erros, administrar o banco de dados e também toda a documentação.
				<br><br>
				<h1>Por que usar o Troquei?</h1>
				<p>O Troquei é um dos pouquíssimos sites que permitem o escambo entre os usuários, além disso é um site bastante simples no uso e intuitivo.
					
				
			</div>
		</section>
		<!-- Footer -->
	<footer id="footer">
			<div class="inner">
				<h2>Troquei</h2>
				<ul class="actions">
					<li>
						<span class="icon fa-phone"> </span><a href="#">(19) 99999-9999</a>
					</li>
					<li>
						<span class="icon fa-envelope"> </span><a href="#">sitetroquei@gmail.com</a>
					</li>
					<li>
						<span class="icon fa-map-marker"> </span>Piracicaba, SP - Brasil
					</li>
				</ul>
			</div>
			<div class="copyright">
				&copy; Projeto criado pela aluna Carolina Molinari.
			</div>
		</footer>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>