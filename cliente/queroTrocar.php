<?php
// Inicia a sessão.
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Troquei</title>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Responsive HTML5 Website landing Page for Developers">
		<meta name="author" content="3rd Wave Media">
		<link rel="shortcut icon" href="../favicon.ico">
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
		<header id="header">
			<nav class="left">
				<?php
					if (isset($_SESSION['user'])) {
						$nomeCliente = $_SESSION['nome'];
						$cpf = $_SESSION['cpf'];
						$nome = current( str_word_count( $nomeCliente , 2 ) );
					}

				?>
			</nav>
			<a href='../index.php'><img id='logoTroquei' src='../images/troquei.png' height='85px' width = '145px'></a>	
			<!-- <img src='../images/troquei.png' height='85px' width = '145px'> -->
			<?php
			if (isset($_SESSION['user'])) {
				$nomeCliente = $_SESSION['nome'];
				$nome = current(str_word_count($nomeCliente, 2));

				print "<form method='post' action = '../pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
				<input type='text' name='pesquisa' style='width:500px; margin-left: -10px;  margin-right: 10px;'/>
				<button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 500px; margin-top: -40px;'>
					Pesquisar
				</button>
				</form>";

				print "<nav class='right'>
				<a href='../cliente/cadastrarProduto.php' class='button alt' style='margin-top: 27px;'>Cadastrar Produto</a>
				<a href='../cliente/solicitacaoTroca.php' class='button alt' style='margin-top: 27px;'>Solicitação de Troca</a>
				</nav>";

			} else {
				print "<form method='post' action = '../pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
				<input type='text' name='pesquisa' style='width:600px; margin-left: 110px; margin-right: 10px;'/>
				<button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 725px; margin-top: -40px;'>
					Pesquisar
				</button>
			</form>";
				print "<nav class='right'>
				<a href='login/login.php' class='button alt' style='margin-top: 27px;'>Entrar</a>
				<a href='cliente/criarConta.php' class='button alt' style='margin-top: 27px;'>Criar conta</a>
			</nav>";
			}
			?>

			
		</header>

		<!--Main -->
		<div id="main">
			<h1 style="color: #49515a; text-align: center;">Selecione um produto para efetivar a troca</h1>
			<div class="inner">
				<!-- Boxes -->
				<div class="thumbnails">
				    
					<?php
					include_once "../bd.php";
				
					#SQL para listagem
					$query = "SELECT * FROM produto where clienteProduto = ? and aceitacaoTroca <> 10";
					$stm = $db -> prepare($query);
					$stm -> bindParam(1, $cpf);

					#Executa o SQL
					if ($stm -> execute()) {
				
						if ($stm -> execute()) {

							while ($row = $stm -> fetch()) {
								$idProduto2 = $row['idProduto'];
								$nome = $row['nomeProduto'];
								$foto = $row['imagem1Produto'];
								$descricao = $row['descricaoProduto'];
								$valor = $row['valorProduto'];
								$idProduto1 = $_GET['idProduto1'];
								$statusProduto = $row['statusProduto'];

								if ($statusProduto == 0){
									print "<div class='box'>
											<div style='width 250px; height: 250px;'>
												<img src='fotos/$foto' style='width: auto; height: 90%; overflow: hidden;  margin-top: 10px;'/>
											</div>		
											<div class='inner'>
												<h3>$nome</h3>
												<p style='color: #ffffff;'>$descricao<br><br></p><p style='color: #ffffff;'>$valor<bR><br></p>
												<a href='sinalizandoTroca.php?idProduto2=$idProduto2&idProduto1=$idProduto1' class='button fit'>Selecionar</a>
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
		<div class="main" style="height: 800px; width: 400px"></div>
		<!-- Footer -->
		<footer id="footer">
			<div class="inner">
				<h2>Troquei</h2>
				<ul class="actions">
					<li>
						<span class="icon fa-phone"> </span><a href="#">(35) 99999-9999</a>
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