<?php
session_start();

$idProduto = $_GET['idProduto'];
$mensagem = $_POST['mensagem'];
$clienteChat = $_SESSION['cpf'];
$nomeClienteMensagem = $_SESSION['nome'];
date_default_timezone_set('Brazil/East');
$data = date('Y-m-d H:i:s');
include_once "../bd.php";
if (empty($mensagem)) {
	header("location:produto.php?idProduto=$idProduto&error=1");
} else {
	$query = "INSERT INTO chat (clienteChat, mensagem, nomeClienteMensagem, idProduto, dataMensagem) VALUES (?,?,?,?,?)";

	$stm = $db -> prepare($query);
	$stm -> bindParam(1, $clienteChat);
	$stm -> bindParam(2, $mensagem);
	$stm -> bindParam(3, $nomeClienteMensagem);
	$stm -> bindParam(4, $idProduto);
	$stm -> bindParam(5, $data);

	if ($stm -> execute()) {
		header("location:produto.php?idProduto=$idProduto");
	} else {
		header("location:produto.php?idProduto=$idProduto&error=1");
	}
}
?>