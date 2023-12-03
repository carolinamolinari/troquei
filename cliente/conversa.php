<?php
// Inicia a sessão.
session_start();
?>
<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<title>Troquei - Mensagens</title>
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
            include_once "../bd.php";
			$idProduto = $_GET['idProduto'];

			$selectDadosCliente = " SELECT 
										c.cpfCliente as clienteProduto, 
										p.idProduto,
										cd.cpfCliente as cpf2,
										p.statusProduto as idProduto2,
										p.aceitacaoTroca  
									FROM produto p 
									INNER JOIN cliente c on c.cpfCliente = p.clienteProduto
									INNER JOIN produto pd on pd.idProduto = p.statusProduto
									INNER JOIN cliente cd on cd.cpfCliente = pd.clienteProduto
									WHERE p.idProduto = $idProduto";
			$executeDados = mysqli_query($bd_mysql, $selectDadosCliente); 
			$resultDados = mysqli_fetch_array($executeDados); 

			$clienteProduto = $resultDados['clienteProduto']; 
			$idProduto2 = $resultDados['idProduto2']; 
			$cpf2 = $resultDados['cpf2']; 
			$aceitacao = $resultDados['aceitacaoTroca']; 


			$selectMensagemOrigem = "SELECT 
											m.mensagem, 
											m.dt_hr, 
											co.nomeCliente as clienteOrigem, 
											cd.nomeCliente as clienteDestino,  
											pd.cidadeProduto, 
											pd.emailProduto,  
											pd.valorProduto,
											pd.rastreio 
									FROM chat m
									INNER JOIN cliente cd ON cd.cpfCliente = m.clienteDestino 
									INNER JOIN cliente co ON co.cpfCliente = m.clienteOrigem               
									INNER JOIN produto pd ON pd.idProduto = m.produtoDestino 
									INNER JOIN produto po ON po.idProduto = m.produtoOrigem               
									WHERE po.idProduto = $idProduto ";

			$selectMensagemDestino = "SELECT 
											m2.mensagem,  
											m2.dt_hr,  
											co2.nomeCliente, 
											cd2.nomeCliente, 
											pd2.cidadeProduto, 
											pd2.emailProduto,  
											pd2.valorProduto,
											pd2.rastreio
									FROM chat m2
									INNER JOIN cliente cd2 ON cd2.cpfCliente = m2.clienteDestino 
									INNER JOIN cliente co2 ON co2.cpfCliente = m2.clienteOrigem                  
									INNER JOIN produto po2 ON po2.idProduto = m2.produtoOrigem 
									INNER JOIN produto pd2 ON pd2.idProduto = m2.produtoDestino       
									WHERE po2.idProduto = $idProduto2
									
									";

			$query_dadosConversa = " $selectMensagemOrigem UNION $selectMensagemDestino ORDER BY dt_hr ASC";
            
            $execute = mysqli_query($bd_mysql, $query_dadosConversa); 
         
			?>

			<div class="container sections-wrapper" style="margin-top: -250px">
			   
						<div class="row">
							<div class="primary col-md-8 col-sm-12 col-xs-12">
								<section class="about section">
									<div class="section-inner" style='height: 600px; '>
									<h2 class="heading" style='color: #49515a; font-size: 35px; text-align: center;'>
										<?php
										
										?>
									</h2>
									
										<div class="content" style="height: 480px; overflow-y: scroll;">
										
    										<div class="w3-content w3-display-container" style="width:100%; height: 250px;">
												<?php

												while($result = mysqli_fetch_assoc($execute)){
													
													$mensagem = $result['mensagem']; 
													$dt_hr = $result['dt_hr']; 
													$clienteOrigem = $result['clienteOrigem']; 
													$clienteDestino = $result['clienteDestino']; 
													$cidadeProduto = $result['cidadeProduto']; 
													$emailProduto = $result['emailProduto']; 
													$valorProduto = $result['valorProduto']; 
													$rastreio = $result['rastreio'];  
													
													ECHO $dt_hr;  echo ' '; echo $clienteOrigem; echo ': ';
													ECHO $mensagem; echo '<br><br>';
												}

												?>
    										</div>
								
							</div><!--//content-->
						</div><!--//section-inner-->
					</section><!--//section-->

					<section class="latest section">
						<div class="section-inner">
							ESCREVA UMA MENSAGEM
							<div class="content">
                            <?php    
                            print"<form method='post' action = 'mensagem.php?idProduto=$idProduto&clienteProduto=$clienteProduto&idProduto2=$idProduto2&cpf2=$cpf2&aceitacao=$aceitacao' style='width: 900px; margin: auto; margin-top: 30px;'>													
                                <input type='text' name='mensagem' style='word-break; color: black; width: 585px; height:100px; margin-left: -10px;  margin-right: 10px;'/>
                                <button type='submit' id='botaoEnviarMensagem' class='button fit' style='font-size: 15px; width: 120px; height: 40px; margin-top: -70px; margin-left: auto;  margin-right: 190px'>
                                    Enviar 
                                </button>
								
                            </form>";
							?>

								<div class="desc text-left">
									
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
                                            ";
									if (!empty($rastreio)){
										print"<li style='font-family: Montserrat;'><i class='fa fa-map-marker'></i><p>Rastreio: $rastreio<br></p>";
									}
									print "<li style='font-family: Montserrat;'><p>$valorProduto<br></p>
									<li style='font-family: Montserrat;'>$clienteDestino</li>
									";
									
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

