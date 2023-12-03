<?php
	$idProduto = $_GET['idProduto'];
	
	include_once "../bd.php";

    
    $query = "UPDATE produto SET aceitacaoTroca = 4 WHERE idProduto = ?";
	$stm = $db -> prepare($query);
	$stm -> bindParam(1, $idProduto);
	
		if ($stm -> execute()) {
			header("location:avisaremos.php");
		}
	
	

?>