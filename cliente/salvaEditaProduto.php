
<?php	
	/* Recebendo os dados do formulário */

	$idProduto = $_GET['idProduto'];
	$nomeProduto = $_POST['nomeProduto'];
	$descricaoProduto = $_POST['descricaoProduto'];
	$valorProduto = $_POST['valorProduto'];
	$estadoProduto = $_POST['estadoProduto'];
	
    include_once "../bd.php";
	
	$query = "  UPDATE produto
		        SET nomeProduto=?, descricaoProduto=?, valorProduto=?, estadoProduto=? 
		        WHERE idProduto=?";
			
	$stm = $db->prepare($query);
	$stm->bindParam(1, $nomeProduto);
	$stm->bindParam(2, $descricaoProduto);
	$stm->bindParam(3, $valorProduto);
	$stm->bindParam(4, $estadoProduto);
	$stm->bindParam(5, $idProduto);
	
	if($stm->execute()) {
	    
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
				    
					$query = "UPDATE produto 
							SET imagem1Produto=? 
							WHERE idProduto = ? ";
					
					$stm = $db -> prepare($query);
					$stm -> bindParam(1, $novoNome);
					$stm -> bindParam(2, $idProduto);
					
					if ($stm -> execute()) {
					    header("location:produto.php?idProduto=$idProduto");
					} 
				} else {echo "Error";}//if (@move_uploaded_file($arquivo_tmp, $destino)) 
			} else {echo "Error";}//if (@move_uploaded_file($arquivo_tmp, $destino)) 
		}
		
	
	  if (isset($_FILES['arquivo2']['name']) && $_FILES['arquivo2']['error'] == 0) {

			$arquivo_tmp = $_FILES['arquivo2']['tmp_name'];
			$nome = $_FILES['arquivo2']['name'];
			$extensao = pathinfo($nome, PATHINFO_EXTENSION);
			$extensao = strtolower($extensao); 

			if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {
	
				$novoNome = uniqid(time()) . '.' . $extensao;
	
				// Concatena a pasta com o nome
				$destino = 'fotos/' . $novoNome;
	
				// tenta mover o arquivo para o destino
				if (@move_uploaded_file($arquivo_tmp, $destino)) {
				    
					$query = "UPDATE produto 
							SET imagem2Produto=? 
							WHERE idProduto = ? ";
					
					$stm = $db -> prepare($query);
					$stm -> bindParam(1, $novoNome);
					$stm -> bindParam(2, $idProduto);
					
					if ($stm -> execute()) {
					    header("location:produto.php?idProduto=$idProduto");
					} 
				} else {echo "Error";}//if (@move_uploaded_file($arquivo_tmp, $destino)) 
			} else {echo "Error";}//if (@move_uploaded_file($arquivo_tmp, $destino)) 
		}
	
	
		  if (isset($_FILES['arquivo3']['name']) && $_FILES['arquivo3']['error'] == 0) {

			$arquivo_tmp = $_FILES['arquivo3']['tmp_name'];
			$nome = $_FILES['arquivo3']['name'];
			$extensao = pathinfo($nome, PATHINFO_EXTENSION);
			$extensao = strtolower($extensao); 

			if (strstr('.jpg;.jpeg;.gif;.png;.jfif', $extensao)) {
	
				$novoNome = uniqid(time()) . '.' . $extensao;
	
				// Concatena a pasta com o nome
				$destino = 'fotos/' . $novoNome;
	
				// tenta mover o arquivo para o destino
				if (@move_uploaded_file($arquivo_tmp, $destino)) {
				    
					$query = "UPDATE produto 
							SET imagem3Produto=? 
							WHERE idProduto = ? ";
					
					$stm = $db -> prepare($query);
					$stm -> bindParam(1, $novoNome);
					$stm -> bindParam(2, $idProduto);
					
					if ($stm -> execute()) {
					    header("location:produto.php?idProduto=$idProduto");
					} 
				} else {echo "Error";}//if (@move_uploaded_file($arquivo_tmp, $destino)) 
			} else {echo "Error";}//if (@move_uploaded_file($arquivo_tmp, $destino)) 
		}	
		
		header("location:produto.php?idProduto=$idProduto");

	}
	else {
		print "<p>Erro ao atualizar produto!</p>";
		print "<input type='button' value='Voltar' onClick='history.go(-1)'>";
	}	
?>
