<?php
// Inicia a sessão.
session_start();
?>
<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<title>Troquei - Produto</title>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Responsive HTML5 Website landing Page for Developers">
		<meta name="author" content="3rd Wave Media">
		<link rel="shortcut icon" href="../favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">	
		<link id="theme-style" rel="stylesheet" href="assetsPerfil/css/styles.css">

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		

	</head>

	<body>
	    
		<?php
			require_once ("headerCliente.php");
			
			$idproduto = $_GET['idProduto'];
			$nomeProduto = '';
			$descricaoProduto = '';
			$valorProduto = '';
			$estadoProduto = '';
			$categoriaProduto = '';
			$cidadeProduto = '';
			$emailProduto = '';
			$clienteProduto = '';

			//* Conectando com o banco de dados para listar registros */
			include_once "../bd.php";

			$query = "SELECT * FROM produto WHERE idproduto=?";

			$stm = $db -> prepare($query);
			$stm -> bindParam(1, $idproduto);
			
			if ($stm -> execute()) {

				if ($row = $stm -> fetch()) {
					$idProduto = $row['idProduto'];
					$nomeProduto = $row['nomeProduto'];
					$valorProduto = $row['valorProduto'];
					$estadoProduto = $row['estadoProduto'];
					$descricaoProduto = $row['descricaoProduto'];
					$categoriaProduto = $row['categoriaProduto'];
					$cidadeProduto = $row['cidadeProduto'];
					$emailProduto = $row['emailProduto'];
					$statusProduto = $row['statusProduto'];
					$aceitacaoTroca = $row['aceitacaoTroca'];
					$clienteProduto = $row['clienteProduto'];
					$foto1 = $row['imagem1Produto'];
					$foto2 = $row['imagem2Produto'];
					$foto3 = $row['imagem3Produto'];

					if($foto2 == NULL && $foto3 == NULL){
						$foto2 = $foto1;
						$foto3 = $foto1;
					}
					else if($foto3 == NULL){
						$foto3 = $foto1;
					}
					else if($foto2 == NULL){
						$foto2 = $foto3;
					}

				}
			} else {
				print '<p>Erro!</p>';
				print_r($stm -> errorInfo());
			}
			?>



			<div class="container sections-wrapper" style="margin-top: -250px">
			   
						<div class="row">
							<div class="primary col-md-8 col-sm-12 col-xs-12">
								<section class="about section">
									<div class="section-inner" style='height: 600px; '>
									<h2 class="heading" style='color: #49515a; font-size: 35px; text-align: center;'>
										<?php
											print "$nomeProduto";
										?>
									</h2>
										<div class="content" style="height: 480px;">
    										<div class="w3-content w3-display-container" style="width:55%; height: 250px;">
    										    
        									    <div class="w3-display-container mySlides">
        										    <img src="fotos/<?php print $foto1; ?>" style="width:100%; height: 100%; max-height: 460px; max-height: 460px;">
        									    </div>
    
            									<div class="w3-display-container mySlides">
            										<img src="fotos/<?php print $foto2; ?>" style="width:100%; height: 100%; max-height: 460px; max-height: 460px;">
            										
            									</div>
    
            									<div class="w3-display-container mySlides">
            										<img src="fotos/<?php print $foto3; ?>" style="width:100%; height: 100%; max-height: 460px; max-height: 460px;">
            										
            									</div>
            
            									<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)" style='margin-right: 250px; margin-left: -100px;  margin-top: 80px;'>
            										&#10094;
            									</button>
            									<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)" style='margin-right: -100px; margin-top: 80px;'>
            										&#10095;
            									</button>		
    
    										</div>



								<script>
									
									var slideIndex = 1;
					
									showDivs(slideIndex);

									function plusDivs(n) {
										showDivs(slideIndex += n);
									}

									function showDivs(n) {
										var i;
										var x = document.getElementsByClassName("mySlides");
										if (n > x.length) {
											slideIndex = 1
										}
										if (n < 1) {
											slideIndex = x.length
										}
										for ( i = 0; i < x.length; i++) {
											x[i].style.display = "none";
										}
										x[slideIndex - 1].style.display = "block";
									}
								</script>
								
							</div><!--//content-->
						</div><!--//section-inner-->
					</section><!--//section-->

					<section class="latest section">
						<div class="section-inner">
							<h2 class="heading">Descrição</h2>
							<div class="content">

								<div class="desc text-left">
									<?php
									print "<p>$descricaoProduto</p>";
									?>
								</div><!--//desc-->

							</div><!--//content-->
						</div><!--//section-inner-->
					</section><!--//section-->
									

				</div><!--//primary-->
				<div class="secondary col-md-4 col-sm-12 col-xs-12">
					<aside class="info aside section">
						<div class="section-inner">

							<div class="content" style="height: 280px;">
								<ul class="list-unstyled">
									<?php
									print "<h2 style='color: #49515a;'>Sobre o produto: </h2>";
									print "<li style='font-family: Montserrat;'><i class='fa fa-map-marker'></i><span class='sr-only'>Localização:</span>$cidadeProduto</li>
											<li style='font-family: Montserrat;'><i class='fa fa-envelope-o'></i><span class='sr-only'>Email:</span>$emailProduto</li>
											<li style='font-family: Montserrat;'><p>$valorProduto<br><br></p>									
											
											";
											

											if (isset($_SESSION['user'])) {
												$cpfCliente = $_SESSION['cpf'];
												if ($clienteProduto == $cpfCliente && $aceitacaoTroca <> 10) {
												    
													print "<a class='button fit' href='editarProduto.php?idProduto=$idProduto' style='margin-right: 50px; font-family='Montserrat';'>Editar Produto</a>";
													print "<a class='button fit' href='apagarProduto.php?idProduto=$idProduto' style='margin-right: 10px; margin-right: 10px;'>Apagar Produto</a>";
												}
												else if ($clienteProduto == $cpfCliente && $aceitacaoTroca = 10) {
												   	print "<br><br><input type='button'  class='btn btn-cta-primary' style='background: #EE3B3B !important; margin-left: 10px; margin-top: -40px;' 
													value='ESSE PRODUTO JÁ FOI TROCADO!' />";
												}

											} else {
												print "<br><br><p style='color: red; text-align: center;'>Crie uma conta e troque agora mesmo!</p>";
												//print "<br>Crie uma conta e troque algo que você não usa por esse produto!";
											}
											if (isset($_SESSION['user'])) {
												$cpfCliente = $_SESSION['cpf'];
												if (($clienteProduto != $cpfCliente) and ($statusProduto == 0) and ($aceitacaoTroca != 10)){
													print "<br><br><a class='btn btn-cta-primary pull-right' href='queroTrocar.php?idProduto1=$idProduto' style='margin-right: 95px;'>Quero trocar!</a>";
												}
												else if (($clienteProduto != $cpfCliente) and ($statusProduto == 0) and ($aceitacaoTroca == 10)){
													print "<br><br><input type='button'  class='btn btn-cta-primary' style='background: #EE3B3B !important; margin-left: 0PX;' 
													value='ESSE PRODUTO JÁ FOI TROCADO!' />";
												}
												else if (($clienteProduto != $cpfCliente) and ($statusProduto != 0)){
													print "<br><br><input type='button'  class='btn btn-cta-primary' style='background: #EE3B3B !important; margin-left: 55px;' 
													value='PRODUTO EM TROCA!' onclick='window.location.href='../produtosCliente.php'/>";
												}
												else if (($clienteProduto == $cpfCliente) and ($statusProduto != 10)){											
													print "<br><br><input type='button'  class='btn btn-cta-primary' style='background: #EE3B3B !important; margin-left: 75px; margin-top: 40px;' 
													value='SEU PRODUTO!' onclick='window.location.href='../produtosCliente.php'/>";
												
												}
												else if(($statusProduto == 10)){
													print "<br><br><p style='color: red;'>Produto Trocado!</p>";
													
												}
											}
									
									?>
									</div>
																									
								</ul>
							</div><!--//content-->
							<?php			
									
									?>
						</div><!--//section-inner-->
					</aside><!--//aside-->

				</div><!--//secondary-->

			</div><!--//row-->
		</div><!--//masonry-->

		<!-- ******FOOTER****** -->
		<footer class="footer">
			<div class="container text-center">
				&copy; Projeto criado pela aluna Carolina Molinari.
			</div><!--//container-->
		</footer><!--//footer-->

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

