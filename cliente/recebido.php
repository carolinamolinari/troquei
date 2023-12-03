<?php
	$idProduto = $_GET['idProduto'];
	
	
	include_once "../bd.php";
	
	$select_status = "
    	   SELECT statusProduto
    		FROM produto
    		WHERE idProduto = $idProduto
    		";
    
    		$e_select_status = mysqli_query($bd_mysql, $select_status);   
    		$r_select_status = mysqli_fetch_array($e_select_status);
    		$idProduto2 = ($r_select_status['statusProduto']);
    
    		if (!($e_select_status = mysqli_query($bd_mysql, $select_status))) {
    			throw new Exception('Erro ao executar o SQL: <pre>' . $select_status . '</pre>');
    		}
	
	
	//update status
		$update_status = "
    	    UPDATE produto 
    	    SET statusProduto = 0, aceitacaoTroca = 10, trocadoPor = $idProduto2
    	    WHERE idProduto = $idProduto;
    		";
    
    		$e_update_status = mysqli_query($bd_mysql, $update_status);   
    		$r_update_status = mysqli_fetch_array($e_update_status);
    	
    		if (!($e_update_status = mysqli_query($bd_mysql, $update_status))) {
    			throw new Exception('Erro ao executar o SQL: <pre>' . $update_status . '</pre>');
    		}
    		
    		
    	$update_status_outro = "
    	    UPDATE produto 
    	    SET aviso = null
    	    WHERE idProduto = $idProduto2;
    		";
    
    		$e_update_status_outro = mysqli_query($bd_mysql, $update_status_outro);   
    		$r_update_status_outro = mysqli_fetch_array($e_update_status_outro);
    	
    		if (!($e_update_status_outro = mysqli_query($bd_mysql, $update_status_outro))) {
    			throw new Exception('Erro ao executar o SQL: <pre>' . $update_status_outro . '</pre>');
    		}
    		
    		
    		header("location:solicitacaoTroca.php");

?>