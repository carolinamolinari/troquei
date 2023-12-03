<?php
// Inicia a sessão.
session_start();
?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<title>Perfil</title>
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
		<link rel="stylesheet" href="../assets/css/main.css" />

	</head>

	<body>	
	
	<?php
		require_once ("headerCliente.php");
	?>
		<header class="header" style="width: 935px; height: 230; margin: auto; margin-left: 50px; margin-top: 00px;">
		
			<div class="container">
			    
				<?php
						include_once("../bd.php");
						$cpfCliente = $_SESSION['cpf'];
						$nomeCliente = '';
						$enderecoCliente = '';
						$estadoCliente = '';
						$cidadeCliente = '';
						$fotoCliente = '';
						$emailCliente = '';
						
						$query = "SELECT * FROM cliente WHERE cpfCliente=?";			
						$stm = $db -> prepare($query);
						$stm -> bindParam(1, $cpfCliente);
						//*Colocar uma div, letras em negrito para poder listar e fazer aparecer as coisas
						if ($stm -> execute()) {
							if ($row = $stm -> fetch()) {							
								$nomeCliente = $row['nomeCliente'];
								$enderecoCliente = $row['enderecoCliente'];
								$estadoCliente = $row['estadoCliente'];
								$cidadeCliente = $row['cidadeCliente'];
								$fotoCliente = $row['fotoCliente'];
								$emailCliente = $row['emailCliente'];
							}
						}	
						if (isset($_SESSION['user'])) {
							if($fotoCliente == null){
								print "<img class='profile-image img-responsive pull-left' style='width:180px; height: 180; margin-top:auto; border-radius: 250px;' src='fotos/fotopadrao.jpg'/>";
							}
							else {
								print "<img class='profile-image img-responsive pull-left' style='width:180px; height: 180px; border-radius: 250px;' src='fotos/$fotoCliente'/>";
							}
							print "<div class='profile-content pull-left'>";
						}
					

						if (isset($_SESSION['user'])) {
						$nome = $nomeCliente;
						print "<h1 class='name'>$nome</h1>";
						print "<a class='button alt' href='editarPerfil.php' style='margin-right: 50px;'>Editar Perfil</a>";
						}
					?>
				</div><!--//profile-->				
			</div><!--//container-->
		</header>
			<div class="secondary col-md-4 col-sm-12 col-xs-12"> 
					<aside class="info aside section" style="width: 30px;height: 24px; ">
						<div class="section-inner" style="width: 470px; height: 240px; margin-top: -240px; margin-left: 1000px;">
							<h2 style='color: #49515a; text-align: center;'>MEUS DADOS</h2>
							
							<div class="content">
								<ul class="list-unstyled">
									<li style="font-family: 'Montserrat';">
										<i class="fa fa-map-marker" style='color: #49515a;'></i>
										<span class="sr-only">Endereço:</span>
										<?php
											if (isset($_SESSION['user'])) {
												
												print "$enderecoCliente";
												
											}
										?>
									</li>
									
									<li style="font-family: 'Montserrat';">
										<i class="fa fa-map-marker" style='color: #49515a;'></i><span class="sr-only" >Cidade:</span>
										<?php
											if (isset($_SESSION['user'])) {
												
												print "$cidadeCliente - $estadoCliente";
										
											}
										?>
									</li>
									
									<li style="font-family: 'Montserrat';">
										<i class="fa fa-envelope-o"style='color: #49515a;'> </i><span class="sr-only">Email:</span>
										<?php
											if (isset($_SESSION['user'])) {
												
												print "$emailCliente";
											}
										?>
									</li>
								</ul>
							</div>
						</div>

		<div class="container sections-wrapper" style="height: 500px; width: 00px; margin: auto;  margin-left: -15px; margin-top: -250px;">
			<div class="row">
				<div class="primary col-md-8 col-sm-12 col-xs-12">
				
					<section class="latest section">
						
						<div class="section-inner" style="width: 1434px; height: 575px; margin-left: 36px;">
						<h2 style='color: #49515a; text-align: center;'>MEUS PRODUTOS</h2> 
						
						<div class="thumbnails">
					
							<?php
				
    							#SQL para listagem
    							$select_produto = "
    							SELECT 
    									idProduto,
    									nomeProduto,
    									imagem1Produto,
    									descricaoProduto
    							FROM 	produto 
    							WHERE 	clienteProduto = '$cpfCliente' 
    							AND aceitacaoTroca <> 10
    							";
     
    							
    							$e_select_produto = mysqli_query($bd_mysql, $select_produto);
    							$r_select_produto = mysqli_fetch_array($e_select_produto);			
    						
    							if (!($e_select_produto = mysqli_query($bd_mysql, $select_produto))) {
    								throw new Exception('Erro ao executar o SQL: <pre>' . $select_produto . '</pre>');
    							}		
    							$qtProdutos = 0;										
    								
    							while($r_select_produto = mysqli_fetch_array($e_select_produto)){
    								$qtProdutos = $qtProdutos + 1;
    							
    								if($qtProdutos <= 3){														
    								
    									$idProduto = $r_select_produto['idProduto'];
    									$nome = $r_select_produto['nomeProduto'];
    									$foto = $r_select_produto['imagem1Produto'];
    									$descricao = $r_select_produto['descricaoProduto'];
    									
    									print "<div class='box'>
    									<div style='width 250px; height: 200px; margin: auto;'>
    										<img src='fotos/$foto' style='width: auto; height: 100%; overflow: hidden; margin-top: 10px;'/>
    									</div>		
    									<div class='inner'>
    										<h3>$nome</p></h3>
    										<p style='color: #ffffff;'>$descricao<br><br></p>
    										<a href='produto.php?idProduto=$idProduto' class='button fit'>Ver mais</a>
    									</div>
    								</div>";
    								
    							    }
    																
    						    }
								
							?>
														
							<input type="button"  class="btn btn-cta-primary" style=" !important; margin-left: AUTO; margin-top:auto;" 
							value="VER TUDO" onclick="window.location.href='../produtosCliente.php'" />		
			
						</div>
						
						
						
						<div class="section-inner" style="width: 1434px; height: 575px; margin-left: -30px; margin-top: 65px">
						<h2 style='color: #49515a; text-align: center;'>MEUS PRODUTOS JÁ TROCADOS</h2> 
						<div class="thumbnails" style="margin-top: 10px">
					
							<?php
    							#SQL para listagem
    							$select_produto = "
    							SELECT 
    									idProduto,
    									nomeProduto,
    									imagem1Produto,
    									descricaoProduto
    							FROM 	produto 
    							WHERE 	clienteProduto = '$cpfCliente' 
    							AND aceitacaoTroca = 10
    							";
     
    							
    							$e_select_produto = mysqli_query($bd_mysql, $select_produto);
    							$r_select_produto = mysqli_fetch_array($e_select_produto);			
    						
    							if (!($e_select_produto = mysqli_query($bd_mysql, $select_produto))) {
    								throw new Exception('Erro ao executar o SQL: <pre>' . $select_produto . '</pre>');
    							}		
    							$qtProdutos = 0;										
    								
    							while($r_select_produto = mysqli_fetch_array($e_select_produto)){
    								$qtProdutos = $qtProdutos + 1;
    							
    								if($qtProdutos <= 3){														
    								
    									$idProduto = $r_select_produto['idProduto'];
    									$nome = $r_select_produto['nomeProduto'];
    									$foto = $r_select_produto['imagem1Produto'];
    									$descricao = $r_select_produto['descricaoProduto'];
    									
    									print "<div class='box'>
    									<div style='width 250px; height: 200px; margin: auto;'>
    										<img src='fotos/$foto' style='width: auto; height: 100%; overflow: hidden; margin-top: 10px;'/>
    									</div>		
    									<div class='inner'>
    										<h3>$nome</p></h3>
    										<p style='color: #ffffff;'>$descricao<br><br></p>
    										<a href='produto.php?idProduto=$idProduto' class='button fit'>Ver mais</a>
    									</div>
    								</div>";
    								
    							    }
    																
    						    }
								
							?>
														
							<input type="button"  class="btn btn-cta-primary" style=" !important; margin-left: AUTO; margin-top:auto;" 
							value="VER TUDO" onclick="window.location.href='../trocados.php'" />		
			
						</div>
						
						
						
						
					</div>
					</section>

				</div>
			
					</aside>

				</div>
			</div>
		</div>


		<footer class="footer" style='margin-left: 0px; margin-top: 1200px;'>
			<div class="container text-center" >
				<small class="copyright"><a href="excluirconta.php" target="_blank">Clique aqui</a> para excluir sua conta.</small>
			</div>
		</footer>

		<!-- Javascript -->
		<script type="text/javascript" src="assetsPerfil/plugins/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="assetsPerfil/plugins/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="assetsPerfil/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assetsPerfil/plugins/jquery-rss/dist/jquery.rss.min.js"></script>		
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>
		<script type="text/javascript" src="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.js"></script>		
		<script type="text/javascript" src="assetsPerfil/js/main.js"></script>

		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.scrolly.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>



	</body>
</html>