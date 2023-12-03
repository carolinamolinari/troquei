<!DOCTYPE HTML>

<html lang = 'pt-br'>
	<head>
		<title>Troquei - Cadastrar Produto</title>
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

		<!-- Header -->
		<header id="header">
		<a href='../index.php'><img src='../images/troquei.png' height='85px' width = '145px'></a>
		
			<nav class="right">
    			<a href="javascript:window.history.go(-1)" class="button alt" style="margin-top: 27px;">Voltar</a>
			</nav>
		</header>

		<!-- Cadastro -->
		<div class="cadastro" style="width: 500px; height: 1000px; margin: auto;">
			<form method="post" enctype="multipart/form-data" action="salvaProduto.php">
				<p style="font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; font-size: 15px; text-align: center;">
					Cadastro do Produto
				</p>
				<?php				
					if(isset($_GET['error'])){
						print "<br><span style='color:red; font-weight: bold; font-size: 20px;'>Erro ao cadastrar produto! Certifique-se de que você inseriu ao menos uma imagem do produto!</span><br>";
					}		
				?>
				<br><label style="width: 200px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Nome do Produto:</label>
				<input type="text" name="nomeProduto" maxlength="50" pattern="[A-Za-z]{3, 255}" title="Preencha esse campo." required/>

				<label style="width: 150px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Valor:</label>
				<select style="margin-bottom: 10px;" name="valorProduto">
					<option value="Até R$5,00"> Até R$5,00 </option>
					<option value="Entre R$5,00 e R$10,00"> Entre R$5,00 e R$10,00 </option>
					<option value="Entre R$15,00 e R$20,00"> Entre R$15,00 e R$20,00 </option>
					<option value="Entre R$20,00 e R$25,00"> Entre R$20,00 e R$25,00</option>
                    <option value="Entre R$25,00 e R$30,00"> Entre R$25,00 e R$30,00 </option>
					<option value="Entre R$30,00 e R$35,00"> Entre R$30,00 e R$35,00 </option>
					<option value="Entre R$35,00 e R$40,00"> Entre R$35,00 e R$40,00</option>
					<option value="Entre R$40,00 e R$45,00"> Entre R$40,00 e R$45,00 </option>
					<option value="Entre R$45,00 e R$50,00"> Entre R$45,00 e R$50,00</option>
                	<option value="Entre R$50,00 e R$60,00"> Entre R$50,00 e R$60,00 </option>
					<option value="Entre R$60,00 e R$70,00"> Entre R$60,00 e R$70,00 </option>
					<option value="Entre R$70,00 e R$80,00"> Entre R$70,00 e R$80,00</option>
                    <option value="Entre R$80,00 e R$90,00"> Entre R$80,00 e R$90,00</option>
                    <option value="Entre R$90,00 e R$100,00"> Entre R$90,00 e R$100,00</option>
                    <option value="Entre R$150,00 e R$200,00"> Entre R$150,00 e R$200,00</option>
                    <option value="Entre R$200,00 e R$250,00"> Entre R$200,00 e R$250,00</option>
                    <option value="Entre R$250,00 e R$300,00"> Entre R$250,00 e R$300,00</option>
                    <option value="Entre R$300,00 e R$350,00"> Entre R$300,00 e R$350,00</option>
                    <option value="Entre R$350,00 e R$400,00"> Entre R$350,00 e R$400,00</option>
                    <option value="Entre R$400,00 e R$450,00"> Entre R$400,00 e R$450,00</option>
                    <option value="Entre R$450,00 e R$500,00"> Entre R$450,00 e R$500,00</option>
                    <option value="Entre R$500,00 e R$550,00"> Entre R$500,00 e R$550,00</option>
                    <option value="Entre R$550,00 e R$600,00"> Entre R$550,00 e R$600,00</option>
                    <option value="Entre R$600,00 e R$650,00"> Entre R$600,00 e R$650,00</option>
                    <option value="Entre R$650,00 e R$700,00"> Entre R$650,00 e R$700,00</option>
                    <option value="Entre R$700,00 e R$750,00"> Entre R$700,00 e R$750,00</option>
                    <option value="Entre R$750,00 e R$800,00"> Entre R$750,00 e R$800,00</option>
                    <option value="Entre R$800,00 e R$850,00"> Entre R$800,00 e R$850,00</option>
                    <option value="Entre R$850,00 e R$900,00"> Entre R$850,00 e R$900,00</option>
                    <option value="Entre R$900,00 e R$950,00"> Entre R$900,00 e R$950,00</option>
                    <option value="Entre R$950,00 e R$1000,00"> Entre R$950,00 e R$1000,00</option>
                    <option value="Acima de R$1000,00"> Acima de R$1000,00 </option>
				</select>

				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Estado:</label>
				<select name="estadoProduto">
					<option value="Otimo">Ótimo</option>
					<option value="Bom">Bom</option>
					<option value="Regular">Regular</option>
				</select>
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Descrição:</label>
				<textarea wrap="hard" style="height:80px; resize: none;" name="descricaoProduto"></textarea>

				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Categoria:</label>
				<select style="margin-bottom: 10px;" name="categoriaProduto">
					<option value="Acessorio">Acessório</option>
					<option value="Decoracao">Decoração</option>
					<option value="Eletronico">Eletrônico</option>
					<option value="Jogo">Jogo</option>
					<option value="Livro">Livro</option>
					<option value="Roupa">Roupa</option>			
				</select>
				
				<p style="font-family: 'Montserrat', Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; font-size: 15px; margin-bottom: 5px;">
					Imagens: (Necessário ao menos uma para efetuar o cadastro do produto)
				</p><br>
				<label style="width: 300px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Imagem 1:</label>
				<input name="arquivo1" type="file"/>
			
				<label style="width: 300px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Imagem 2:</label>
				<input name="arquivo2" type="file"/>
				
				<label style="width: 300px; height: 2px; display: inline-block;
				color: black; font-family: 'Montserrat', Arial, Helvetica, sans-serif; size: 15px;">Imagem 3:</label>
				<input name="arquivo3" type="file"/>
				<br>
				
				<button type="submit" id="botaoCadastro" class="button fit" style='margin-top: 10px;'>
					Cadastrar Produto
				</button>
			</form>
		</div>

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