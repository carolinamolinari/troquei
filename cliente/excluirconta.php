<?php	

session_start();
include_once "../bd.php";

if (isset($_SESSION['user'])) {
	$cpfCliente = $_SESSION['cpf'];

	$sql_inicial = "
	SELECT 		
				emailCliente,
				statusProduto
	FROM 		produto p
	LEFT JOIN	cliente c ON p.emailProduto = c.emailCliente
	WHERE		c.cpfCliente = $cpfCliente
	";
	$e_sql_inicial = mysqli_query($bd_mysql, $sql_inicial);
    $r_sql_inicial = mysqli_fetch_array($e_sql_inicial);

	$emailProduto = $r_sql_inicial['emailCliente'];
	$statusProduto = $r_sql_inicial['statusProduto'];
	
	if($statusProduto <> 0){
		print "<p>Erro ao excluir conta! Você possui transações em andamento!</p>";
		print "<a href='../index.php'>Voltar</a>";
	}
	else{
		
		$sql_delete_produto = "
		DELETE 
		FROM produto 
		WHERE emailProduto = '$emailProduto' ";

		if (!($qry_delete_produto = mysqli_query($bd_mysql, $sql_delete_produto))) {
			throw new Exception('Erro ao executar o SQL: <pre>' . $sql_delete_produto . '</pre>');             
		}	

		$sql_delete_cliente = "
		DELETE 
		FROM cliente 
		WHERE cpfCliente = '$cpfCliente' ";

		if (!($qry_delete_cliente = mysqli_query($bd_mysql, $sql_delete_cliente))) {
			throw new Exception('Erro ao executar o SQL: <pre>' . $sql_delete_cliente . '</pre>');             
		}		

		unset($_SESSION['user']);
		print "<p>Conta excluída com sucesso!</p>";
		print "<a href='../login/login.php' class='button alt' style='margin-top: 27px;'>Voltar</a>";

		}
	
}
else {
	print "<p>Erro ao excluir conta!</p>";
	print "<a href='../index.php'>Voltar</a>";
}



	
?>