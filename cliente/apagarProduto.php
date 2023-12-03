


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
		
	<?php	


			include_once "../bd.php";
			$idProduto = $_GET['idProduto'];

			$select_id = "
			SELECT 
					statusProduto, 
					aceitacaoTroca
			FROM 	produto
			WHERE 	idProduto = $idProduto
			";

			$e_sql_id = mysqli_query($bd_mysql, $select_id);
			$r_sql_id = mysqli_fetch_array($e_sql_id); 

			$produto_troca = $r_sql_id['statusProduto'];
			$aceitacaotroca = $r_sql_id['aceitacaoTroca'];

			if($produto_troca == 0 && ($aceitacaotroca == 0 || $aceitacaotroca == 10)){
				$query = "DELETE FROM produto WHERE idProduto=?";
					
				$stm = $db->prepare($query);
				$stm->bindParam(1, $idProduto);
					
				if($stm->execute()) {
					header("location:../index.php");
					
				}

			}
			else if($produto_troca <> 0) {
				print "
				<div style='height: 300px;'>                
					<span style='color:red; font-weight: bold; font-size: 20px; text-align:center'>
					</br> 
						<div style='margin-left: 10px; margin-top: 100px;'>
						Não é possível apagar esse produto, ele está envolvido em uma transação de troca com outro usuário.	
						</div>
					</span>               
				</div>
				";
				print " <nav class='right'>
						<a href='solicitacaoTroca.php' class='button alt' style='margin-top: 3px; margin-bottom: 50px; margin-left: 700px;'>Voltar</a>
						</nav>";
			}
			else if($aceitacaotroca == 10) {
				print "
				<div style='height: 300px;'>                
					<span style='color:red; font-weight: bold; font-size: 20px; text-align:center'>
					</br> 
						<div style='margin-left: 10px; margin-top: 100px;'>
						Não é possível apagar esse produto, ele já foi trocado com outro usuário.	
						</div>
					</span>               
				</div>
				";

				print " <nav class='right'>
						<a href='solicitacaoTroca.php' class='button alt' style='margin-top: 3px; margin-bottom: 50px; margin-left: 700px;'>Voltar</a>
						</nav>";
			}
			
			/*
			$idProduto = $_GET['idProduto'];
			$query = "DELETE FROM produto WHERE idProduto=?";
					
			$stm = $db->prepare($query);
			$stm->bindParam(1, $idProduto);
				
			if($stm->execute()) {
				header("location:../index.php");
				
			}
			else {
				print "<p>Erro</p>";
			}*/


	?>



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