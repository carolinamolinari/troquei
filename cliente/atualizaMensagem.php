<?php
	
    $produtoDestino = $_GET['idProduto'];
    $produtoOrigem = $_GET['idProduto2'];
  

	include_once "../bd.php";

        $insert_mensagem = "
            UPDATE chat
            SET lida = 1
            WHERE produtoDestino = $produtoDestino
            AND produtoOrigem = $produtoOrigem
        ";
        
        $execute = mysqli_query($bd_mysql, $insert_mensagem);          
        if (!($execute = mysqli_query($bd_mysql, $insert_mensagem))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $insert_mensagem . '</pre>');             
        }
       
        header("location:conversa.php?idProduto=$produtoOrigem");
?>