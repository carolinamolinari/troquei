<?php
	$rastreio = $_POST['rastreio'];
    $idProduto = $_GET['idProduto'];
    
	include_once "../bd.php";

        $update_rastreio = "
            UPDATE  produto
            SET     rastreio = '$rastreio'
            WHERE   idProduto = $idProduto
        ";
        $e_update_rastreio= mysqli_query($bd_mysql, $update_rastreio);
        //$r_update_rastreio = mysqli_fetch_array($e_update_rastreio);
        
        if (!($e_update_rastreio = mysqli_query($bd_mysql, $update_rastreio))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $update_rastreio . '</pre>');             
        }
         header("location:solicitacaoTroca.php");


?>