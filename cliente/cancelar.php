<?php
// Inicia a sessão.
session_start();
?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<title>Perfil</title>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Responsive HTML5 Website landing Page for Developers">
		<meta name="author" content="3rd Wave Media">
		<link rel="shortcut icon" href="../favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>	
		<link rel="stylesheet" href="assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
		<link id="theme-style" rel="stylesheet" href="assetsPerfil/css/styles.css">
		<link rel="stylesheet" href="../assets/css/main.css" />

	</head>

	<body>	
	
	<?php
		require_once ("headerCliente.php");
	?>
		
<?php
	$idProduto = $_GET['idProduto'];//meu produto 12
    
	include_once "../bd.php";
 

    $select_id = "
    SELECT statusProduto
    FROM produto
    WHERE idProduto = $idProduto
    ";
    $e_sql_id = mysqli_query($bd_mysql, $select_id);
    $r_sql_id = mysqli_fetch_array($e_sql_id); 
    $produto_troca = $r_sql_id['statusProduto'];//produto pelo qual estou trocando o meu

    $select_outro_produto = "
    SELECT 
            rastreio, 
            aceitacaoTroca
    FROM    produto
    WHERE   idProduto = $produto_troca
    ";
    $e_outro_produto = mysqli_query($bd_mysql, $select_outro_produto);
    $r_outro_produto = mysqli_fetch_array($e_outro_produto); 
    $rastreio_outro_produto = $r_outro_produto['rastreio'];//produto pelo qual estou trocando o meu
    $aceitacao_outro_produto = $r_outro_produto['aceitacaoTroca'];

    $rastreio_produto = "
    SELECT 
            rastreio
            
    FROM    produto
    WHERE   statusProduto = $produto_troca
    ";
    $e_rastreio_produto = mysqli_query($bd_mysql, $rastreio_produto);
    $r_rastreio_produto = mysqli_fetch_array($e_rastreio_produto); 
    $rastreio_produto = $r_rastreio_produto['rastreio'];

    if($aceitacao_outro_produto == 10){
        
        print "
        <div style='height: 300px;'>                
            <span style='color:red; font-weight: bold; font-size: 20px; text-align:center'>
            </br> 
                <div style='margin-left: 10px; margin-top: 100px;'>
                Não é possível cancelar, o outro usuário ja recebeu seu produto! 
                </div>
            </span>               
        </div>
        ";
        print " <nav class='right'>
                   <a href='solicitacaoTroca.php' class='button alt' style='margin-top: 3px; margin-bottom: 50px; margin-left: 700px;'>Voltar</a>
                </nav>";
        
    }
    else if ($rastreio_outro_produto != NULL){
        print "
        <div style='height: 300px;'>                
            <span style='color:red; font-weight: bold; font-size: 20px; text-align:center'>
            </br> 
                <div style='margin-left: 10px; margin-top: 100px;'>
                Não é possível cancelar, o produto já foi enviado!<br>
                Código de rastreio: $rastreio_outro_produto
                </div>
            </span>               
        </div>
        ";
        print " <nav class='right'>
				    <a href='solicitacaoTroca.php' class='button alt' style='margin-top: 3px; margin-bottom: 50px; margin-left: 700px;'>Voltar</a>
			    </nav>";
       
    }
    else if ($rastreio_produto != NULL){
        print "
        <div style='height: 300px;'>                
            <span style='color:red; font-weight: bold; font-size: 20px; text-align:center'>
            </br> 
                <div style='margin-left: 10px; margin-top: 100px;'>
                Não é possível cancelar, o produto já foi enviado por você!<br>
                Código de rastreio: $rastreio_produto
                </div>
            </span>               
        </div>
        ";
        print " <nav class='right'>
				    <a href='solicitacaoTroca.php' class='button alt' style='margin-top: 3px; margin-bottom: 50px; margin-left: 700px;'>Voltar</a>
			    </nav>";
       
    }
    else{
    

        $select_id = "
        SELECT statusProduto
        FROM produto
        WHERE idProduto = $idProduto
        ";
        $e_sql_id = mysqli_query($bd_mysql, $select_id);
        $r_sql_id = mysqli_fetch_array($e_sql_id); 
        $id_troca_produto = $r_sql_id['statusProduto'];


		$update_aceitacaoTroca_solicitado = "
        UPDATE produto
        SET aceitacaoTroca = 0
        WHERE idProduto = $idProduto
        ";
        $e_update_aceitacaoTroca_solicitado = mysqli_query($bd_mysql, $select_id);
        $r_update_aceitacaoTroca_solicitado = mysqli_fetch_array($e_update_aceitacaoTroca_solicitado); 

        if (!($e_update_aceitacaoTroca_solicitado = mysqli_query($bd_mysql, $update_aceitacaoTroca_solicitado))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $update_aceitacaoTroca_solicitado . '</pre>');             
        }

        $update_statusProduto_solicitado = "
        UPDATE produto
        SET statusProduto = 0
        WHERE idProduto = $idProduto
        ";
        $e_update_statusProduto_solicitado = mysqli_query($bd_mysql, $update_statusProduto_solicitado);
        $r_update_statusProduto_solicitado = mysqli_fetch_array($e_update_statusProduto_solicitado); 

        if (!($e_update_statusProduto_solicitado = mysqli_query($bd_mysql, $update_statusProduto_solicitado))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $update_statusProduto_solicitado . '</pre>');             
        }
        


        $update_aceitacaoTroca_solicita = "
        UPDATE produto
        SET aceitacaoTroca = 0
        WHERE statusProduto = $idProduto
        ";
        $e_update_aceitacaoTroca_solicita = mysqli_query($bd_mysql, $update_aceitacaoTroca_solicita);
        $r_update_aceitacaoTroca_solicita = mysqli_fetch_array($e_update_aceitacaoTroca_solicita); 

        if (!($e_update_aceitacaoTroca_solicita = mysqli_query($bd_mysql, $update_aceitacaoTroca_solicita))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $update_aceitacaoTroca_solicita . '</pre>');             
        }

        $update_statusProduto_solicita = "
        UPDATE produto
        SET statusProduto = 0
        WHERE statusProduto = $idProduto
        ";
        $e_update_statusProduto_solicita = mysqli_query($bd_mysql, $update_statusProduto_solicita);
        $r_update_statusProduto_solicita = mysqli_fetch_array($update_statusProduto_solicita); 

        if (!($e_update_statusProduto_solicita = mysqli_query($bd_mysql, $update_statusProduto_solicita))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $update_statusProduto_solicita . '</pre>');             
        }

        $update_aviso = "
        UPDATE produto
        SET aviso = 'NULL'
        WHERE statusProduto = $idProduto
        ";
        $e_update_aviso = mysqli_query($bd_mysql, $update_aviso);
        $r_update_aviso = mysqli_fetch_array($e_update_aviso); 

        if (!($e_update_aviso = mysqli_query($bd_mysql, $update_aviso))) {
            throw new Exception('Erro ao executar o SQL: <pre>' . $update_aviso . '</pre>');             
        }
        header("location:solicitacaoTroca.php");
    }

	

?>

	<!-- Footer -->
    <footer id="footer">
			<div class="inner">
				<h2>Troquei</h2>
				<ul class="actions">
					<li>
						<span class="icon fa-phone"> </span><a href="#">(19) 99999-9999</a>
					</li>
					<li>
						<span class="icon fa-envelope"> </span><a href="#">sitetroquei@gmail.com</a>
					</li>
					<li>
						<span class="icon fa-map-marker"> </span>Piracicaba, SP - Brasil
					</li>
				</ul>
			</div>
			<div class="copyright">
				&copy; Projeto criado pela aluna Carolina Molinari.
			</div>
		</footer>

		<!-- Javascript -->
		<script type="text/javascript" src="assetsPerfil/plugins/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="assetsPerfil/plugins/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="assetsPerfil/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assetsPerfil/plugins/jquery-rss/dist/jquery.rss.min.js"></script>		
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>
		<script type="text/javascript" src="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.js"></script>		
		<script type="text/javascript" src="assetsPerfil/js/main.js"></script>

		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.scrolly.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>



	</body>
</html>