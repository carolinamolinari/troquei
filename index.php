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

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<?php
			require_once ("header.php");
			require_once("bd.php");
			if (isset($_SESSION['user'])) {
				$emailCliente = $_SESSION['user'];
				$nomeCliente = $_SESSION['nome'];
				$nome = current( str_word_count( $nomeCliente , 2 ) );
				
				if($emailCliente){
				    
					$sql_busca_mensagem = "
						SELECT 
									p.statusProduto, 
									p2.nomeProduto,
									p.emailProduto, 
									c.nomeCliente as avisante,
									p2.aviso
						
						FROM        produto p 
						
						INNER JOIN produto p2 ON p.statusProduto = p2.idProduto 
						INNER JOIN cliente c ON c.emailCliente = p.emailProduto 
						
						WHERE 		p2.emailProduto = '$emailCliente' 
						AND 		p2.aviso = 1
					";

					
					if (!($e_sql_busca_mensagem = mysqli_query($bd_mysql, $sql_busca_mensagem))) {
						throw new Exception('Erro ao executar o SQL: <pre>' . $sql_busca_mensagem . '</pre>');
					}
					$e_sql_busca_mensagem = mysqli_query($bd_mysql, $sql_busca_mensagem);
					$r_sql_busca_mensagem = mysqli_fetch_array($e_sql_busca_mensagem);
				
												
					if($r_sql_busca_mensagem){				
					    
					    $produtoAvisado = $r_sql_busca_mensagem['nomeProduto'];
						$emailAvisante = $r_sql_busca_mensagem['emailProduto'];
						$statusProdutoAvisante = $r_sql_busca_mensagem['statusProduto'];
						$nomeAvisante = $r_sql_busca_mensagem['avisante'];
	
							
						print "
						<div >                
							<span style='color:red; font-size: 16px;'>
							</br> 
							<h3 class='name' style='color:red; margin-left: 20px;'>ATENÇÃO</h3>
								<h4 style='color:red; margin-left: 20px;'>Uma de suas transações recebeu um aviso. <br>
									O usuário $nomeAvisante ainda não recebeu $produtoAvisado.  <br> 
									Entre em contato pelo e-mail: $emailAvisante</h4>
							</span>               
						</div>			
						";

						
					}
				
				}

			}

				
		?>
		
					
		<!-- Banner -->
		<section id="banner" style="margin-top: auto; height: 700px;">
			<div class="content">
				<h1>Troquei!</h1>
				<p>
					Troque aquilo que você não quer por algo que você quer.
				</p>
			</div>
		</section>
		<div style="height: 10px;">
		    
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