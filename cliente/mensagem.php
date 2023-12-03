<?php

    include_once "../bd.php";
	
    $funcao = $_GET['funcao'];
    $idProduto = $_GET['idProduto'];
    $idProduto2 = $_GET['idProduto2'];

    if($funcao == 0){
        $mensagem = $_POST['mensagem'];
        $aceitacao = $_GET['aceitacao'];
        $clienteDestino = $_GET['cpf2'];
        $clienteOirgem = $_GET['clienteProduto'];


        $select_horario_banco = "
            SELECT  CURRENT_TIMESTAMP() AS tempo
            FROM chat LIMIT 1
        "; 

        $execute = mysqli_query($bd_mysql, $select_horario_banco); 
        $result = mysqli_fetch_assoc($execute);
        $dt_hr_mensagem = $result['tempo'];    
                
        //Insere a mensagem no banco
        $insert_mensagem = "
            INSERT INTO chat (
                clienteOrigem, clienteDestino, produtoOrigem, produtoDestino, dt_hr, mensagem, aceitacaoTroca, lida
            ) VALUES ('$clienteOirgem', '$clienteDestino', '$idProduto', '$idProduto2', '$dt_hr_mensagem', '$mensagem', '$aceitacao', 0)
        "; 
        
        
        if (!($execute = mysqli_query($bd_mysql, $insert_mensagem))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $insert_mensagem . '</pre>');             
        }
    
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
    }

    if($funcao == 1){
        $produtoDestino = $idProduto;//$_GET['idProduto2'];
        $produtoOrigem = $idProduto2;//$_GET['idProduto'];
  

        $insert_mensagem = "
            UPDATE chat
            SET lida = 1
            WHERE produtoDestino = $produtoDestino
            AND produtoOrigem = $produtoOrigem         
        ";
        
             
        if (!($execute = mysqli_query($bd_mysql, $insert_mensagem))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $insert_mensagem . '</pre>');             
        }
       
        header("location:conversa.php?idProduto=$produtoOrigem");
    }
       

?>