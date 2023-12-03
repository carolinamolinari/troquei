<?php

	$aceitacao = $_GET['aceitacao'];
	$idProduto = $_GET['idProduto'];
	$idProduto2 = $_GET['idProduto2'];
	include_once "../bd.php";
	if ($aceitacao == 1){
		$query = "UPDATE produto SET aceitacaoTroca = 1 WHERE idProduto = ?";
		$stm = $db -> prepare($query);
		$stm -> bindParam(1, $idProduto);
		if ($stm -> execute()) {
			$query = "UPDATE produto SET aceitacaoTroca = 3 WHERE idProduto = ?";
			$stm = $db -> prepare($query);
			$stm -> bindParam(1, $idProduto2);


			if ($stm -> execute()) {
				header("location:solicitacaoTroca.php");	
			}
			
		}
	}

	if ($aceitacao == 2){
		$query = "UPDATE produto SET aceitacaoTroca = 0 WHERE idProduto = ?";
		$stm = $db -> prepare($query);
		$stm -> bindParam(1, $idProduto);

		$query2 = "UPDATE produto SET statusProduto = 0 WHERE idProduto = ?";
		$stm = $db -> prepare($query2);
		$stm -> bindParam(1, $idProduto);
		if ($stm -> execute()) {
			$query = "UPDATE produto SET aceitacaoTroca = 0 WHERE idProduto = ?";
			$stm = $db -> prepare($query);
			$stm -> bindParam(1, $idProduto2);
			if($stm -> execute()){
				$query = "UPDATE produto SET statusProduto = 0 WHERE idProduto = ?";
				$stm = $db -> prepare($query);
				$stm -> bindParam(1, $idProduto2);	
			}
			
			if ($stm -> execute()) {
				header("location:solicitacaoTroca.php");	
			}
			
		}
	}


?>