<?php
// Inicia a sess�o.
session_start();

// Pegando os dados de login enviados.
$usuario = $_POST['emailCliente'];
$senha = $_POST['senhaCliente'];

/* Conectando com o banco de dados para cadastrar registros */
include_once "../bd.php";
	
$query = "SELECT * FROM cliente WHERE emailCliente=?";
$stm = $db->prepare($query);
$stm->bindParam(1, $usuario);
$stm->execute();



	if ($row = $stm -> fetch()) {
		
		$senhaCripto = $row['senhaCliente'];
	
		if (password_verify($senha, $senhaCripto)) {

			$_SESSION['user'] = $usuario;
			$_SESSION['nome'] = $row['nomeCliente'];
			$_SESSION['cpf'] = $row['cpfCliente'];
			$_SESSION['endereco'] = $row['enderecoCliente'];
			$_SESSION['dataNascimento'] = $row['dataNascimentoCliente'];
			$_SESSION['email'] = $row['emailCliente'];
			$_SESSION['estado'] = $row['estadoCliente'];
			$_SESSION['cidade'] = $row['cidadeCliente'];
			$_SESSION['fotoCliente'] = $row['fotoCliente'];

			header("location:../index.php");
		}
		else{
			$query = "SELECT * FROM cliente WHERE emailCliente=? AND senhaCliente=?";
			$stm = $db->prepare($query);
			$stm->bindParam(1, $usuario);
			$stm->bindParam(2, $senha);
			$stm->execute();
			if ($row = $stm -> fetch()) {
				// Login efetuado com sucesso.
			
				// Armazenando usuário na sessao.
				$_SESSION['user'] = $usuario;
				$_SESSION['nome'] = $row['nomeCliente'];
				$_SESSION['cpf'] = $row['cpfCliente'];
				$_SESSION['endereco'] = $row['enderecoCliente'];
				$_SESSION['dataNascimento'] = $row['dataNascimentoCliente'];
				$_SESSION['email'] = $row['emailCliente'];
				$_SESSION['estado'] = $row['estadoCliente'];
				$_SESSION['cidade'] = $row['cidadeCliente'];
				$_SESSION['fotoCliente'] = $row['fotoCliente'];
				
				
				// Redirecionando para a p�gina inicial.
				header("location:../index.php");
			} else {
				header("location:login.php?error=login");
			}	
		}
	} 
	else {
		header("location:login.php?error=login");
	}

?>
