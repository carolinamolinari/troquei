<?php
// Inicia a sessão.
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Troquei</title>
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
		?>
		
		<!--Main -->

		<div id="main">
			
			<div class="inner">

				<!-- Boxes -->
				<div class="thumbnails">
					<?php
					$categoriaProduto = 'Eletronico';
					include_once "bd.php";
					
					#SQL para listagem
					$query = "SELECT * FROM produto where categoriaProduto like '%".$categoriaProduto."%'";
					$stm = $db -> prepare($query);
				

					#Executa o SQL
					if ($stm -> execute()) {
						#Continua no próximo episódio
						#Continuando...
						if ($stm -> execute()) {

							while ($row = $stm -> fetch()) {
								$idProduto = $row['idProduto'];
								$nome = $row['nomeProduto'];
								$foto = $row['imagem1Produto'];
								$descricao = $row['descricaoProduto'];
								$aceitacao = $row['aceitacaoTroca'];
								
								if($aceitacao != 10){
									print "<div class='box'>
										<div style='width 250px; height: 250px;'>
											<img src='cliente/fotos/$foto' style='width: auto; height: 100%; overflow: hidden;'/>
										</div>		
										<div class='inner'>
											<h3>$nome</h3>
											<p style='color: #ffffff;'>$descricao<br><br></p>
											<a href='cliente/produto.php?idProduto=$idProduto' class='button fit'>Ver mais</a>
										</div>
									</div>";
								}					
							}							
						}
					}
					
					?>

				</div>

			</div>
		</div>
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