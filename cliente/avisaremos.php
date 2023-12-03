<?php
// Inicia a sessÃ£o.
session_start();
?>


<!DOCTYPE HTML>

<html>
	<head>
		<title>Troquei</title>
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
		
		

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body>

    <?php
        $idProduto = $_GET['idProduto'];        
        include_once "../bd.php";       

		$select_produto = "
		SELECT 	
			emailProduto as email, 
			idProduto as id
		FROM 	produto 
		WHERE 	trocadoPor =  $idProduto
		OR 		statusProduto = $idProduto

		";
		
		
		$e_select_produto = mysqli_query($bd_mysql, $select_produto);
		$r_select_produto = mysqli_fetch_array($e_select_produto);
        $emailProduto = $r_select_produto['email'];
		$idProduto = $r_select_produto['id'];

		if (!($e_select_produto = mysqli_query($bd_mysql, $select_produto))) {
			throw new Exception('Erro ao executar o SQL: <pre>' . $select_produto . '</pre>');
		}
		
		

		$update_aviso = "
		UPDATE produto
		SET aviso = 1
		WHERE emailProduto = '$emailProduto'
		AND idProduto = $idProduto

		";
		
		
		$e_update_aviso = mysqli_query($bd_mysql, $update_aviso);
		

		if (!($e_select_cadastro_pais = mysqli_query($bd_mysql, $update_aviso))) {
			throw new Exception('Erro ao executar o SQL: <pre>' . $update_aviso . '</pre>');
		}

    ?>

	<!-- Header -->
    <header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>

               
				<?php
                
					if (isset($_SESSION['user'])) {
					$nomeCliente = $_SESSION['nome'];
					$nome = current( str_word_count( $nomeCliente , 2 ) );
					print "<nav id='menu'>
								<ul class='links'>
							<li>
								<a href='cliente/perfil.php' class='button alt' style='margin-top: 27px;'>$nome</a>
								<a href='../login/logout.php' class='button alt' style='margin-top: 27px; margin-top: 10px;'>Sair</a>
								<a href='../produtosCliente.php' class='button alt' style='margin-top: 27px; margin-top: 10px;'>Meus Produtos</a>
								</li>
							<li>
								<a href='index.php'>Página Inicial</a>
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
								<a href='index.php'>Página Inicial</a>
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
			<a href='../index.php'><img id='logoTroquei' src='../images/troquei.png' height='85px' width = '145px'></a>	
				
			<?php
            
			if (isset($_SESSION['user'])) {
				$nomeCliente = $_SESSION['nome'];
				$nome = current(str_word_count($nomeCliente, 2));

				print "
                <form method='post' action = '../pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
                    <input type='text' name='pesquisa' style='width:600px; margin-left: -10px;  margin-right: 10px;'/>
                    <button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 600px; margin-top: -40px;'>
                        Pesquisar
                    </button>
				</form>";

				print "<nav class='right'>
				    <a href='solicitacaoTroca.php' class='button alt' style=''width: 900px; margin: auto; margin-top: 30px;'>Voltar</a>
				</nav>";

			} else {
				print "
                <form method='post' action = 'pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
                    <input type='text' name='pesquisa' style='width:600px; margin-left: 110px; margin-right: 10px;'/>
                    <button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 725px; margin-top: -40px;'>
                        Pesquisar
                    </button>
                </form>";

				print "
                <nav class='right'>
                    <a href='login/login.php' class='button alt' style='margin-top: 27px;'>Entrar</a>
                    <a href='cliente/criarConta.php' class='button alt' style='margin-top: 27px;'>Criar conta</a>
			    </nav>";
			} ?>
			
            </header>
			<?php
			
				print "
				<div style='height: 400px;'>                
					<span style='color:red; font-weight: bold; font-size: 20px; text-align:center'>
					</br> 
						<div style='margin-left: 10px; margin-top: 100px;'>
						Avisaremos ao usuário que houve um problema. <br>
						Enquanto isso, você pode entrar em contato pelo email: 
						$emailProduto
						</div>
					</span>               
				</div>
				";
				print " <nav class='right'>
				<a href='solicitacaoTroca.php' class='button alt' style='margin-top: 3px; margin-bottom: 50px; margin-left: 700px;'>Voltar</a>
			 </nav>";
			
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

		<!-- Scripts -->
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