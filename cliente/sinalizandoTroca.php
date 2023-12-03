<?php
	$idProduto1 = $_GET['idProduto1'];
	$idProduto2 = $_GET['idProduto2'];
	
	include_once "../bd.php";
	$query = "UPDATE produto SET statusProduto = ? WHERE idProduto = ?";
	$stm = $db->prepare($query);
	$stm->bindParam(1, $idProduto2);
	$stm->bindParam(2, $idProduto1);
	$stm->execute();
	
	$query = "UPDATE produto SET statusProduto = ? WHERE idProduto = ?";
	$stm = $db->prepare($query);
	$stm->bindParam(1, $idProduto1);
	$stm->bindParam(2, $idProduto2);
	$stm->execute();
	
	$query = "UPDATE produto SET aceitacaoTroca = 2 WHERE idProduto = ?";
	$stm = $db->prepare($query);
	$stm->bindParam(1, $idProduto2);
	$stm->execute();
	
	header("location:solicitacaoTroca.php");


?>