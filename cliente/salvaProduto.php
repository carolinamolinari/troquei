<?php

	session_start();

	include_once "../bd.php";

	if (isset($_SESSION['user'])) {
		$clienteProduto = $_SESSION['cpf'];
		$cpfCliente = $_SESSION['cpf'];
		$cidadeProduto = '';
		$emailProduto= '';
		
		$query = "SELECT * FROM cliente WHERE cpfCliente=?";			
		$stm = $db -> prepare($query);
		$stm -> bindParam(1, $cpfCliente);

		//*Colocar uma div, letras em negrito para poder listar e fazer aparecer as coisas
		if ($stm -> execute()) {
			if ($row = $stm -> fetch()) {							
				$cidadeProduto = $row['cidadeCliente'];
				$emailProduto = $row['emailCliente'];
			}
		}

		$nomeProduto = $_POST['nomeProduto'];
		$valorProduto = $_POST['valorProduto'];
		$estadoProduto = $_POST['estadoProduto'];
		$descricaoProduto = $_POST['descricaoProduto'];
		$categoriaProduto = $_POST['categoriaProduto'];
		$statusProduto = '';
		$flag = 0;

		$insert_produto = 
								"INSERT INTO produto 
								(nomeProduto, 
								valorProduto, 
								estadoProduto, 
								descricaoProduto, 
								categoriaProduto, 
								statusProduto, 
								clienteProduto, 
								cidadeProduto, 
								emailProduto) 
							VALUES (
								'$nomeProduto', 
								'$valorProduto', 
								'$estadoProduto', 
								'$descricaoProduto', 
								'$categoriaProduto', 
								'$statusProduto', 
								'$clienteProduto', 
								'$cidadeProduto', 
								'$emailProduto'
							)";
		  
		if (!($execute = mysqli_query($bd_mysql, $insert_produto))) {
			throw new Exception('Erro ao executar o SQL: <pre>' . $insert_produto . '</pre>');             
		}
	


		if($execute){

			 //$lastIdProduto = $db -> lastInsertId();

			 $query_id = "SELECT idProduto FROM produto WHERE nomeProduto = '$nomeProduto' AND clienteProduto = '$clienteProduto' ORDER BY 1 ASC LIMIT 1";
			 $execute = mysqli_query($bd_mysql, $query_id);
			 $res_id = mysqli_fetch_assoc($execute);
			 $lastIdProduto = $res_id['idProduto'];
			
			//IMAGENS - INSERINDO

			#Imagem 1
			if (isset($_FILES['arquivo1']['name']) && $_FILES['arquivo1']['error'] == 0) {

				$arquivo_tmp = $_FILES['arquivo1']['tmp_name'];
				$nome = $_FILES['arquivo1']['name'];

				// Pega a extensão
				$extensao = pathinfo($nome, PATHINFO_EXTENSION);

				// Converte a extensão para minúsculo
				$extensao = strtolower($extensao);

				// Somente imagens, .jpg;.jpeg;.gif;.png. Aqui eu enfileiro as extensões permitidas e separo por ';'. Isso serve apenas para eu poder pesquisar dentro desta String
				if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {

					// Cria um nome único para esta imagem. Evita que duplique as imagens no servidor. Evita nomes com acentos, espaços e caracteres não alfanuméricos
					$novoNome1 = uniqid(time()) . '.' . $extensao;

					// Concatena a pasta com o nome
					$destino = 'fotos/' . $novoNome1;

					// tenta mover o arquivo para o destino
					if (@move_uploaded_file($arquivo_tmp, $destino)) {
						$query = "
							UPDATE produto 
							SET imagem1Produto='$novoNome1' 
							WHERE idProduto = '$lastIdProduto'
						";
						if (!($execute = mysqli_query($bd_mysql, $query))) {
							throw new Exception('Erro ao executar o SQL: <pre>' . $query . '</pre>');             
						}else{
							$flag = $flag + 1;
						}
					
					}
				}
			}

			#Imagem 2
			if (isset($_FILES['arquivo2']['name']) && $_FILES['arquivo2']['error'] == 0) {

				$arquivo_tmp = $_FILES['arquivo2']['tmp_name'];
				$nome = $_FILES['arquivo2']['name'];
				$extensao = pathinfo($nome, PATHINFO_EXTENSION);
				$extensao = strtolower($extensao);

				if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {

					$novoNome2 = uniqid(time()) . '.' . $extensao;
					$destino = 'fotos/' . $novoNome2;

					if (@move_uploaded_file($arquivo_tmp, $destino)) {
						$query = "
							UPDATE produto 
							SET imagem2Produto='$novoNome2' 
							WHERE idProduto = '$lastIdProduto'
						";
						if (!($execute = mysqli_query($bd_mysql, $query))) {
							throw new Exception('Erro ao executar o SQL: <pre>' . $query . '</pre>');             
						}else{
							$flag = $flag + 1;
						}
					} 
				} 
			} 
			#Imagem 3
			if (isset($_FILES['arquivo3']['name']) && $_FILES['arquivo3']['error'] == 0) {

				$arquivo_tmp = $_FILES['arquivo3']['tmp_name'];
				$nome = $_FILES['arquivo3']['name'];
				$extensao = pathinfo($nome, PATHINFO_EXTENSION);
				$extensao = strtolower($extensao);

				if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {
					
					$novoNome3 = uniqid(time()) . '.' . $extensao;
					$destino = 'fotos/' . $novoNome3;

					if (@move_uploaded_file($arquivo_tmp, $destino)) {
						$query = "
							UPDATE produto 
							SET imagem3Produto='$novoNome3' 
							WHERE idProduto = '$lastIdProduto'
						";
						if (!($execute = mysqli_query($bd_mysql, $query))) {
							throw new Exception('Erro ao executar o SQL: <pre>' . $query . '</pre>');             
						}else{
							$flag = $flag + 1;
						}
						
					} 
				} 
			} 
			
			if ($flag > 0) {
				header("location:../produtosCliente.php");
		
			} else {
				header("location:cadastrarProduto.php?error=cadastroProduto");
			}
		} else {
			header("location:cadastrarProduto.php?error=cadastroProduto");


		}

	}
?>
