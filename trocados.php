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
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>	
		<link rel="stylesheet" href="cliente/assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="cliente/assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
		<link id="theme-style" rel="stylesheet" href="cliente/assetsPerfil/css/styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
		<header id="header">
		
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
				<?php
					if (isset($_SESSION['user'])) {
					$nomeCliente = $_SESSION['nome'];
					$cpf = $_SESSION['cpf'];
					$nome = current( str_word_count( $nomeCliente , 2 ) );
					print "<nav id='menu'>
								<ul class='links'>
							<li>
								<a href='cliente/perfil.php' class='button alt' style='margin-top: 27px;'>$nome</a>
								<a href='login/logout.php' class='button alt' style='margin-top: 27px; margin-top: 10px;'>Sair</a>
								<a href='produtosCliente.php' class='button alt' style='margin-top: 27px; margin-top: 10px;'>Meus Produtos</a>
								</li>
							<li>
								<a href='listagem.php'>Todos os Produtos</a>
							</li>
							<li>
								<a href='acessorios.php'>Acessorios</a>
							</li>
							<li>
								<a href='deco.php'>Decoração</a>
							</li>
							<li>
								<a href='eletronicos.php'>Eletrônicos</a>
							</li>
							<li>
								<a href='jogos.php'>Jogos</a>
							</li>
							<li>
								<a href='livros.php'>Livros</a>
							</li>
							<li>
								<a href='roupas.php'>Roupas</a>
							</li>
				
						</ul>
						</nav>";
					}
					else{
						print "<nav id='menu'>
								<ul class='links'>
								<li>
								<a href='listagem.php'>Todos os Produtos</a>
							</li>
							<li>
								<a href='acessorios.php'>Acessorios</a>
							</li>
							<li>
								<a href='deco.php'>Decoração</a>
							</li>
							<li>
								<a href='eletronicos.php'>Eletrônicos</a>
							</li>
							<li>
								<a href='jogos.php'>Jogos</a>
							</li>
							<li>
								<a href='livros.php'>Livros</a>
							</li>
							<li>
								<a href='roupas.php'>Roupas</a>
							</li>
				
						</ul>
						</nav>";
					}

				?>
			</nav>
			<a href='index.php'><img id='logoTroquei' src='images/troquei.png' height='85px' width = '145px'></a>	
			<!-- <img src='../images/troquei.png' height='85px' width = '145px'> -->
			<?php
			
			if (isset($_SESSION['user'])) {
				$nomeCliente = $_SESSION['nome'];
				$nome = current(str_word_count($nomeCliente, 2));

				print "<form method='post' action = 'pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
				<input type='text' name='pesquisa' style='width:560px; margin-left: -10px;  margin-right: 10px;'/>
				<button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 565px; margin-top: -40px;'>
					Pesquisar
				</button>
				</form>";

				print "<nav class='right'>
				<a href='cliente/cadastrarProduto.php' class='button alt' style='margin-top: 20px;'>Cadastrar Produto</a>
				<a href='cliente/solicitacaoTroca.php' class='button alt' style='margin-top: 27px;'>Solicitação de Troca</a>
				</nav>";

			} else {
			
				print "<form method='post' action = 'pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
				<input type='text' name='pesquisa' style='width:560px; margin-left: -10px;  margin-right: 10px;'/>
				<button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 565px; margin-top: -40px;'>
					Pesquisar
				</button>
				</form>";

				print "<nav class='right'>
				<a href='cliente/cadastrarProduto.php' class='button alt' style='margin-top: 20px;'>Cadastrar Produto</a>
				<a href='cliente/solicitacaoTroca.php' class='button alt' style='margin-top: 27px;'>Solicitação de Troca</a>
				</nav>";
			}
			?>
		</header>


		<!--Main -->
		<div id="main">
			<div class="inner">
		
			<h1 style="color: #49515a; text-align: center;">Aqui estão seus produtos que já foram trocados</h1>
				<!-- Boxes -->
				<div class="thumbnails">
					<?php
					include_once "bd.php";
				
					#SQL para listagem
					$query = "SELECT * FROM produto WHERE clienteProduto = ? AND aceitacaoTroca = 10 ";
					$stm = $db -> prepare($query);
					$stm -> bindParam(1, $cpf);

					#Executa o SQL
					if ($stm -> execute()) {
						
						if ($stm -> execute()) {

							while ($row = $stm -> fetch()) {
								$idProduto = $row['idProduto'];
								$nome = $row['nomeProduto'];
								$foto = $row['imagem1Produto'];
								$descricao = $row['descricaoProduto'];

								print "<div class='box'>
										<div style='width 250px; height: 250px;'>
											<img src='cliente/fotos/$foto' style='width: auto; height: 90%; overflow: hidden; margin-top: 10px;'/>
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
					
					?>

				</div>

			</div>
		</div>
		 <div class="main" style="height:150px"></div> 
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