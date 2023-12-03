<?php
session_start();

	$nomeCliente = $_POST['nomeCliente'];
	$dataNascimentoCliente = $_POST['dataNascimentoCliente'];
	$enderecoCliente = $_POST['enderecoCliente'];
	$cidadeCliente = $_POST['cidadeCliente'];
	$estadoCliente = $_POST['estadoCliente'];
	$cpfCliente = $_POST['cpfCliente'];
	$cpf = $_SESSION['cpf'];

	include_once "../bd.php";
	$query = "UPDATE cliente SET nomeCliente=?, dataNascimentoCliente=?, enderecoCliente=?, cidadeCliente=?, estadoCliente=? WHERE cpfCliente=?";
		
	$stm = $db->prepare($query);
	$stm->bindParam(1, $nomeCliente);
	$stm->bindParam(2, $dataNascimentoCliente);
	$stm->bindParam(3, $enderecoCliente);
	$stm->bindParam(4, $cidadeCliente);
	$stm->bindParam(5, $estadoCliente);
	$stm->bindParam(6, $cpf);
	
	if ($cpfCliente == $cpf){
		if($stm->execute()) {
			if (isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0) {

					$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
					$nome = $_FILES['arquivo']['name'];
			
					// Pega a extensão
					$extensao = pathinfo($nome, PATHINFO_EXTENSION);
			
					// Converte a extensão para minúsculo
					$extensao = strtolower($extensao);
			
					// Somente imagens, .jpg;.jpeg;.gif;.png
					// Aqui eu enfileiro as extensões permitidas e separo por ';'
					// Isso serve apenas para eu poder pesquisar dentro desta String
					if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {
						// Cria um nome único para esta imagem
						// Evita que duplique as imagens no servidor.
						// Evita nomes com acentos, espaços e caracteres não alfanuméricos
						$novoNome = uniqid(time()) . '.' . $extensao;
			
						// Concatena a pasta com o nome
						$destino = 'fotos/' . $novoNome;
			
						// tenta mover o arquivo para o destino
						if (@move_uploaded_file($arquivo_tmp, $destino)) {
							$query = "UPDATE cliente SET fotoCliente=? WHERE cpfCliente = ? ";
							$stm = $db -> prepare($query);
							$stm -> bindParam(1, $novoNome);
							$stm -> bindParam(2, $cpfCliente);
							if ($stm -> execute()) {
								header("location:perfil.php");
							} 
						} else {
							header("location:editarConta.php?error='1'");
						}
					} else {
						header("location:editarConta.php?error='1'");
					}
				}
			header("location:perfil.php");
		} else {
			header("location:editarPerfil.php?error=1.php");
		}
		
	} else {
			header("location:editarPerfil.php?error=1.php");
		}	
?> 