<?php

	/*$ds = 'mysql:host=localhost;dbname=u787258236_troquei;charset=utf8';
	$user = 'root';
	$pass = '';
	$db = new PDO($ds, $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));



	//mysql
	$hostname='localhost';
	$username='root';
	$password='';
	$dbname='u787258236_troquei';
	$bd_mysql = mysqli_connect($hostname,$username, $password, $dbname);*/
	include_once "../bd.php";
	$cpfCliente = $_POST['cpfCliente'];
	$nomeCliente = $_POST['nomeCliente'];
	$dataNascimentoCliente = $_POST['dataNascimentoCliente'];
	$senhaCliente = ($_POST['senhaCliente']);
	$senhaCliente = password_hash($senhaCliente, PASSWORD_DEFAULT);
	$emailCliente = $_POST['emailCliente'];
	$enderecoCliente = $_POST['enderecoCliente'];
	$estadoCliente = $_POST['estadoCliente'];
	$cidadeCliente = $_POST['cidadeCliente'];

	
	
	$query_verifica = "	SELECT cpfCliente 
						FROM cliente 
						WHERE cpfCliente = '$cpfCliente' 
						OR emailCliente = '$emailCliente'";
	$execute_verifica = mysqli_query($bd_mysql, $query_verifica); 
	$return_verifica = mysqli_fetch_assoc($execute_verifica);

	$cliente = $return_verifica['cpfCliente'];

	if(empty($cliente)){
	
		$query = "INSERT INTO cliente (
						cpfCliente,
						nomeCliente,
						dataNascimentoCliente,
						emailCliente,	
						senhaCliente,
						enderecoCliente,
						estadoCliente,
						cidadeCliente				  		   
						) VALUES (
						'$cpfCliente',
						'$nomeCliente',
						'$dataNascimentoCliente',
						'$emailCliente',
						'$senhaCliente',
						'$enderecoCliente',
						'$estadoCliente',
						'$cidadeCliente')";
		$execute = mysqli_query($bd_mysql, $query); 


		if (isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0) {

			$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
			$nome = $_FILES['arquivo']['name'];

			$extensao = pathinfo($nome, PATHINFO_EXTENSION);
			$extensao = strtolower($extensao);
		
			if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {
				
				$novoNome = uniqid(time()) . '.' . $extensao;

				// Concatena a pasta com o nome
				$destino = 'fotos/' . $novoNome;

				// tenta mover o arquivo para o destino
				if (@move_uploaded_file($arquivo_tmp, $destino)) {

					echo '<pre>'.$query = "	UPDATE cliente 
								SET fotoCliente = '$novoNome' 
								WHERE cpfCliente = '$cpfCliente' ";
					$execute = mysqli_query($bd_mysql, $query); 
					

					if ($execute) {
				
						header("location:../index.php");
					} else {
						$fotopadrao = file("fotopadrao.jpg");
					}
				} else {
					print "<span style='color:red; font-weight: bold; font-size: 20px;'>Erro!</span>";
					
				}
			} else {
				print "<span style='color:red; font-weight: bold; font-size: 20px;'>Erro!</span>";
				
			}
		}
		header("location:../login/login.php");
	}
	else {
		print "<span style='color:red; font-weight: bold; font-size: 20px;'>Erro! O usuário já está cadastrado. $cliente</span>";
		
	}
	
	

?>