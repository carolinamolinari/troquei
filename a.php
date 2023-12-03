<?php
        // Inicia a sessão.
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Troquei</title>
			<!-- Meta -->
		<meta charset    = "utf-8">
		<meta http-equiv = "X-UA-Compatible" content                                                     = "IE=edge">
		<meta name       = "viewport" content                                                            = "width=device-width, initial-scale=1.0">
		<meta name       = "description" content                                                         = "Responsive HTML5 Website landing Page for Developers">
		<meta name       = "author" content                                                              = "3rd Wave Media">
		<link rel        = "shortcut icon" href                                                          = "../favicon.ico">
		<link href       = 'http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel = 'stylesheet' type = 'text/css'>
		<link href       = 'http://fonts.googleapis.com/css?family=Montserrat:400,700' rel               = 'stylesheet' type = 'text/css'>
		<link rel        = "stylesheet" href                                                             = "assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel        = "stylesheet" href                                                             = "assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel        = "stylesheet" href                                                             = "http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel        = "stylesheet" href                                                             = "http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">
		<link id         = "theme-style" rel                                                             = "stylesheet" href = "assetsPerfil/css/styles.css">
		<link rel        = "stylesheet" href                                                             = "../assets/css/main.css" />
	</head>
	<body>
	

	<header id = "header">
		
		<nav class = "left">
		<?php
				if (isset($_SESSION['user'])) {
					$nomeCliente = $_SESSION['nome'];
					$cpf         = $_SESSION['cpf'];
					$nome        = current( str_word_count( $nomeCliente , 2 ) );
				}

		?>
	
		</nav>
		<?php
		require_once ("headerCliente.php");
	?>	
	</header>


		<!--Main -->
		<div id    = "main">
		<h1  style = "color: #49515a; text-align: center;">Aqui estão suas solicitações de troca</h1>
		<div class = "inner">
				<!-- Boxes -->
				<div class = "thumbnails">
			
					<?php
						include_once "../bd.php";
						$funcao = 0;
			
						#SQL para listagem
						$select_produto = "
						SELECT 	
								nomeProduto,
								descricaoProduto,
								idProduto,
								imagem1Produto,
								clienteProduto,
								valorProduto,
								aceitacaoTroca,
								statusProduto
							
						FROM 	produto 
						WHERE	statusProduto <> 0 
						AND clienteProduto = '$cpf'
						";
						$e_select_produto = mysqli_query($bd_mysql, $select_produto);
						$r_select_produto = mysqli_fetch_assoc($e_select_produto);
												  //print_r($r_select_produto);
						if (!($e_select_produto = mysqli_query($bd_mysql, $select_produto))) {
							throw new Exception('Erro ao executar o SQL: <pre>' . $select_produto . '</pre>');
						}						
					
						
						while($r_select_produto = mysqli_fetch_assoc($e_select_produto)){
							$idProduto      = $r_select_produto ['idProduto'];
							$nome           = $r_select_produto ['nomeProduto'];
							$descricao      = $r_select_produto ['descricaoProduto'];
							$statusProduto  = $r_select_produto ['statusProduto'];
							$aceitacao      = $r_select_produto ['aceitacaoTroca'];
							$clienteProduto = $r_select_produto ['clienteProduto'];

							$query2 = "
							SELECT 	* 
							FROM 	produto 
							WHERE 	idProduto = ?";
							$stm2 = $db -> prepare($query2);
							$stm2 -> bindParam(1, $statusProduto);
							$stm2 -> execute();

							if ($stm2 -> execute()) {

								while($row2 = $stm2 -> fetch()) {

									$nome2      = $row2['nomeProduto'];
									$descricao2 = $row2['descricaoProduto'];
									$idProduto2 = $row2['idProduto'];
									$foto2      = $row2['imagem1Produto'];
									$cpf2       = $row2['clienteProduto'];
									$valor2     = $row2['valorProduto'];
									$rastreio2  = $row2['rastreio'];
									
									
									print "<div class='box' style='height: 100%;'>	
											<div class = 'inner'>
												<h3>$nome</h3>
												<h3>POR</h3>
												<a   href  = 'produto.php?idProduto=$statusProduto' style = 'color: #836FFF; font-size: 30px; font-family: Montserrat;'>$nome2</a><p>
												<div style = 'width 150px; height: 150px;'>
												<img src   = 'fotos/$foto2' style                         = 'font-family: Montserrat; width: auto; height: 100%; overflow: hidden; border-radius: 10px;'/>
												</div>
									<br><p><p style = 'color: #ffffff; font-size: 15px; font-family: Montserrat;'>$descricao2<br></p>
									<br><p    style = 'color: #ffffff; font-size: 15px; font-family: Montserrat;'>$valor2<br></p>";		

					
									if($aceitacao == 1){//aceitou a troca,  agurdando recebimento
										$query = "
										SELECT *
										FROM cliente 													
										WHERE cpfCliente = ?";
										$stm = $db -> prepare($query);
										$stm -> bindParam(1, $cpf2);

										if ($stm -> execute()) {
											while ($row = $stm -> fetch()) {
												$contatoCliente = $row['emailCliente'];
												$endereco2      = $row['enderecoCliente'];
												$estado2        = $row['estadoCliente'];
												$cidade2        = $row['cidadeCliente'];
												
											}
											
											print "<br>
											<p style = 'font-family: Montserrat; color: #87CEEB; font-size: 18px;'>Endereço para envio: <br> $endereco2 - $cidade2, $estado2</p>
											<br><br>
											<p style = 'font-family: Montserrat; color: #ffffff; font-size: 18px;'>Código de rastreio: $rastreio2 <BR></p>
											<br><br>
											<a href = 'recebido.php?idProduto=$idProduto' class   = 'button fit'>Já Recebi</a>
											<a href = 'avisaremos.php?idProduto=$idProduto' class = 'button fit'>Não Recebi</a>
											<a href = 'cancelar.php?idProduto=$idProduto' class   = 'button fit'>Cancelar Troca</a>";

																	  //BLOCO DE VERIFICAÇÃO DO RASTREIO: Se nunca tiver sido enviado codigo do rastreio, aparece uma caixa de texto e botao de enviar rastreio. Se não ele desaparece

											$verifica_rastreio = "
												SELECT rastreio 
												FROM produto 
												WHERE idProduto = $idProduto
											";
											
											$executeDados    = mysqli_query($bd_mysql, $verifica_rastreio);
											$resultDados     = mysqli_fetch_assoc($executeDados);
											$verify_rastreio = $resultDados['rastreio'];


											if(empty($verify_rastreio)){
												print"<form method='post' action = 'rastreio.php?idProduto=$idProduto' style='width: 900px; margin: auto; margin-top: 30px;'>
												<input  type = 'text' name = 'rastreio' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
												<button type = 'submit' id = 'botaoEnviarRastreio' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
													Enviar Rastreio
												</button></form>";
											}

																	  //BLOCO DE VERIFICAÇÃO DAS MENSAGENS	

																	  //Verificando se já existem mensagens com aquele produto
											$verifica_mensagem = "
												SELECT id, lida, dt_hr, clienteOrigem
												FROM chat 
												WHERE (clienteOrigem = '$cpf' AND produtoDestino = $idProduto2)														
												OR (clienteOrigem = '$cpf2' AND produtoDestino = $idProduto)		
												order by 3 desc												
											";
											
											$executeDados         = mysqli_query($bd_mysql, $verifica_mensagem);
											$resultDados          = mysqli_fetch_assoc($executeDados);
											$verify_mensagem      = $resultDados['id'];
											$ultima_mensagem_lida = $resultDados['lida'];
											$cliente              = $resultDados['clienteOrigem'];

																	  //Se não exite ele coloca uma caixa de tecto e um botao para ser enviada a primeira mensagem
											if(empty($verify_mensagem)){
												print"<form method='post' action = 'mensagem.php?idProduto=$idProduto&clienteProduto=$clienteProduto&idProduto2=$idProduto2&cpf2=$cpf2&aceitacao=$aceitacao' style='width: 900px; margin: auto; margin-top: 30px;'>													
												<input  type = 'text' name = 'mensagem' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
												<button type = 'submit' id = 'botaoEnviarMensagem' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
													Enviar Mensagem
												</button></form>																	
												";
											}
																	  //Se ja existem ele substitui a box de enviar mensagem por um botao que direciona pra pagina de conversas
											else{
											
												if(!empty($verify_mensagem)){
													
													if(($ultima_mensagem_lida == 0) && ($cliente <> $cpf )){
														$funcao = 1;
														print"<a href='mensagem.php?idProduto=$idProduto&idProduto2=$idProduto2&funcao=$funcao' class='button fit' style=' background-color:Tomato;'> Você tem novas Mensagens!</a>";  //se tiver mensagens = 0 fica vermelho, senao fica fica normal		
													}
													else{
														print"<a href='conversa.php?idProduto=$idProduto' class='button fit'> Minhas Mensagens </a>";
													}
												} 
											}
										
										}	
													
									}
									else if ($aceitacao == 2){//aguardando outro usuario aceitar ou  nao a solicitação de troca

										print "<br><p style='color: #87CEEB; font-size: 18px; font-family: Montserrat; '>Aguardando aceitação ou recusa... </p>
												<br><br><a href='cancelar.php?idProduto=$idProduto' class='button fit'>Cancelar Solicitação de Troca</a>";

																  //BLOCO DE VERIFICAÇÃO DAS MENSAGENS
											$verifica_mensagem = "
												SELECT id, lida, dt_hr, clienteOrigem
												FROM chat 
												WHERE (clienteOrigem = '$cpf' AND produtoDestino = $idProduto2)														
												OR (clienteOrigem = '$cpf2' AND produtoDestino = $idProduto)		
												order by 1 desc												
											";										
											$executeDados         = mysqli_query($bd_mysql, $verifica_mensagem);
											$resultDados          = mysqli_fetch_assoc($executeDados);
											$verify_mensagem      = $resultDados['id'];
											$ultima_mensagem_lida = $resultDados['lida'];
											$cliente              = $resultDados['clienteOrigem'];
								
											if(empty($verify_mensagem)){
												print"<form method='post' action = 'mensagem.php?idProduto=$idProduto&clienteProduto=$clienteProduto&idProduto2=$idProduto2&cpf2=$cpf2&aceitacao=$aceitacao' style='width: 900px; margin: auto; margin-top: 30px;'>													
												<input  type = 'text' name = 'mensagem' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
												<button type = 'submit' id = 'botaoEnviarMensagem' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
													Enviar Mensagem
												</button></form>																	
												";
											}
											else{
									
												if(($ultima_mensagem_lida == 0) && ($cliente <> $cpf )){	
													$funcao = 1;
																								
													print"<a href='mensagem.php?idProduto=$idProduto&idProduto2=$idProduto2&funcao=$funcao' class='button fit' style=' background-color:Tomato;'> Você tem novas Mensagens!</a>";  //se tiver mensagens = 0 fica vermelho, senao fica fica normal		
												}
												
												else{
													print"<a href='conversa.php?idProduto=$idProduto' class='button fit'> Minhas Mensagens </a>";
												}
											}
								
									}							
									else if ($aceitacao == 3){ //aceitou a troca,  agurdando recebimento
										
										$query = "SELECT * FROM cliente where cpfCliente = ?";
										$stm   = $db -> prepare($query);
										$stm -> bindParam(1, $cpf2);
										if ($stm -> execute()) {
											while ($row = $stm -> fetch()) {
												$endereco2 = $row['enderecoCliente'];
												$estado2   = $row['estadoCliente'];
												$cidade2   = $row['cidadeCliente'];
											}
											print "<br><p style='color: #87CEEB; font-size: 18px; font-family: Montserrat; '>Endereço para envio: <br> $endereco2 - $cidade2, $estado2</p>
											<br><br>
											<p style = 'font-family: Montserrat; color: #ffffff; font-size: 18px;'>Código de rastreio: $rastreio2</p>
											<br><br>
											<a href = 'recebido.php?idProduto=$idProduto' class   = 'button fit'>Já Recebi</a>
											<a href = 'avisaremos.php?idProduto=$idProduto' class = 'button fit'>Não Recebi</a>
											<a href = 'cancelar.php?idProduto=$idProduto' class   = 'button fit'>Cancelar Troca</a>";

											$verifica_rastreio = "
												SELECT rastreio 
												FROM produto 
												WHERE idProduto = $idProduto
											";
											
											$executeDados    = mysqli_query($bd_mysql, $verifica_rastreio);
											$resultDados     = mysqli_fetch_assoc($executeDados);
											$verify_rastreio = $resultDados['rastreio'];


											if(empty($verify_rastreio)){
												print"<form method='post' action = 'rastreio.php?idProduto=$idProduto' style='width: 900px; margin: auto; margin-top: 30px;'>
											<input  type = 'text' name = 'rastreio' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
											<button type = 'submit' id = 'botaoEnviarRastreio' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
												Enviar Rastreio
											</button></form>";
											}

																	  //BLOCO DE VERIFICAÇÃO DAS MENSAGENS
											$verifica_mensagem = "
												SELECT id, lida, dt_hr, clienteOrigem
												FROM chat 
												WHERE (clienteOrigem = '$cpf' AND produtoDestino = $idProduto2)														
												OR (clienteOrigem = '$cpf2' AND produtoDestino = $idProduto)		
												order by 3 desc												
											";										
											$executeDados         = mysqli_query($bd_mysql, $verifica_mensagem);
											$resultDados          = mysqli_fetch_assoc($executeDados);
											$verify_mensagem      = $resultDados['id'];
											$ultima_mensagem_lida = $resultDados['lida'];
											$cliente              = $resultDados['clienteOrigem'];
								
											if(empty($verify_mensagem)){
												print"<form method='post' action = 'mensagem.php?idProduto=$idProduto&clienteProduto=$clienteProduto&idProduto2=$idProduto2&cpf2=$cpf2&aceitacao=$aceitacao' style='width: 900px; margin: auto; margin-top: 30px;'>													
												<input  type = 'text' name = 'mensagem' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
												<button type = 'submit' id = 'botaoEnviarMensagem' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
													Enviar Mensagem
												</button></form>																	
												";
											}
											else{
											
												if(($ultima_mensagem_lida == 0) && ($cliente <> $cpf )){	
													$funcao = 1;
													print"<a href='mensagem.php?idProduto=$idProduto&idProduto2=$idProduto2&funcao=$funcao' class='button fit' style=' background-color:Tomato;'> Você tem novas Mensagens!</a>";  //se tiver mensagens = 0 fica vermelho, senao fica fica normal		
												}
												
												else{
													print"<a href='conversa.php?idProduto=$idProduto' class='button fit'> Minhas Mensagens </a>";
												}
											}

										}
									}
									else if ($aceitacao == 4){//aceitou a troca,  agurdando recebimento
										print "<p style='font-family: Montserrat; color: #ffffff; font-size: 18px;'>Código de rastreio: $rastreio2 <br><br></p>
												<a href = 'recebido.php?idProduto=$idProduto' class   = 'button fit'>Já Recebi</a>
												<a href = 'avisaremos.php?idProduto=$idProduto' class = 'button fit'>Não Recebi</a>
												<a href = 'cancelar.php?idProduto=$idProduto' class   = 'button fit'>Cancelar Troca</a>";

										$verifica_rastreio = "
											SELECT rastreio 
											FROM produto 
											WHERE idProduto = $idProduto
										";
										
										$executeDados    = mysqli_query($bd_mysql, $verifica_rastreio);
										$resultDados     = mysqli_fetch_assoc($executeDados);
										$verify_rastreio = $resultDados['rastreio'];
										
										if(empty($verify_rastreio)){
											print"<form method='post' action = 'rastreio.php?idProduto=$idProduto' style='width: 900px; margin: auto; margin-top: 30px;'>
										<input  type = 'text' name = 'rastreio' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
										<button type = 'submit' id = 'botaoEnviarRastreio' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
											Enviar Rastreio
										</button></form>";
										}

																  //BLOCO DE VERIFICAÇÃO DAS MENSAGENS
										$verifica_mensagem = "
											SELECT id, lida, dt_hr, clienteOrigem
											FROM chat 
											WHERE (clienteOrigem = '$cpf' AND produtoDestino = $idProduto2)														
											OR (clienteOrigem = '$cpf2' AND produtoDestino = $idProduto)	
											order by 3 desc												
										";										
										$executeDados         = mysqli_query($bd_mysql, $verifica_mensagem);
										$resultDados          = mysqli_fetch_assoc($executeDados);
										$verify_mensagem      = $resultDados['id'];
										$ultima_mensagem_lida = $resultDados['lida'];
										$cliente              = $resultDados['clienteOrigem'];

						
										if(empty($verify_mensagem)){
											print"<form method='post' action = 'mensagem.php?idProduto=$idProduto&clienteProduto=$clienteProduto&idProduto2=$idProduto2&cpf2=$cpf2&aceitacao=$aceitacao' style='width: 900px; margin: auto; margin-top: 30px;'>													
											<input  type = 'text' name = 'mensagem' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
											<button type = 'submit' id = 'botaoEnviarMensagem' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
												Enviar Mensagem
											</button></form>																	
											";
										}
										else{
											if(($ultima_mensagem_lida == 0) && ($cliente <> $cpf )){	
																		  //Seta como lida a mensagem apos o usuario clicar
												$funcao = 1;
												print"<a href='mensagem.php?idProduto=$idProduto&idProduto2=$idProduto2&funcao=$funcao' class='button fit' style=' background-color:Tomato;'> Você tem novas Mensagens!</a>";  //se tiver mensagens = 0 fica vermelho, senao fica fica normal										
												
											
											}
											
											else{
												print"<a href='conversa.php?idProduto=$idProduto' class='button fit'> Minhas Mensagens </a>";
											} 
										}												
									}
						
									else{
										print "<br><a href='aceitacaoTroca.php?aceitacao=1&idProduto=$idProduto&idProduto2=$idProduto2' class='button fit'>Aceitar</a>
												<a href = 'aceitacaoTroca.php?aceitacao=2&idProduto=$idProduto&idProduto2=$idProduto2' class = 'button fit'>Recusar</a>
										";

										
																	  //BLOCO DE VERIFICAÇÃO DAS MENSAGENS	

																	  //Verificando se já existem mensagens com aquele produto

											$verifica_mensagem = "
												SELECT id, lida, dt_hr, clienteOrigem
												FROM chat 
												WHERE (clienteOrigem = '$cpf' AND produtoDestino = $idProduto2)														
												OR (clienteOrigem = '$cpf2' AND produtoDestino = $idProduto)		
												order by 3 desc												
											";
											
											$executeDados         = mysqli_query($bd_mysql, $verifica_mensagem);
											$resultDados          = mysqli_fetch_assoc($executeDados);
											$verify_mensagem      = $resultDados['id'];
											$ultima_mensagem_lida = $resultDados['lida'];
											$cliente              = $resultDados['clienteOrigem'];

																	  //Se não exite ele coloca uma caixa de tecto e um botao para ser enviada a primeira mensagem
											if(empty($verify_mensagem)){
												print"<form method='post' action = 'mensagem.php?idProduto=$idProduto&clienteProduto=$clienteProduto&idProduto2=$idProduto2&cpf2=$cpf2&aceitacao=$aceitacao' style='width: 900px; margin: auto; margin-top: 30px;'>													
												<input  type = 'text' name = 'mensagem' style            = 'width: 200px; margin-left: -10px;  margin-right: 10px; color: white;'/>
												<button type = 'submit' id = 'botaoEnviarMensagem' class = 'button fit' style = 'font-size: 10px; width: 120px; height: 40px; margin-top: -40px; margin-left: 200px;  margin-right: auto'>
													Enviar Mensagem
												</button></form>																	
												";
											}
																	  //Se ja existem ele substitui a box de enviar mensagem por um botao que direciona pra pagina de conversas
											else{
											
												if(!empty($verify_mensagem)){
													
													if(($ultima_mensagem_lida == 0) && ($cliente <> $cpf )){
														$funcao = 1;                                                                                                                                                                       //atualizar	
														print   "<a  href='mensagem.php?idProduto=$idProduto&idProduto2=$idProduto2&funcao=$funcao' class='button fit' style=' background-color:Tomato;'> Você tem novas Mensagens!</a>";  //se tiver mensagens = 0 fica vermelho, senao fica fica normal	
															
													}
													
													else{
														print"<a href='conversa.php?idProduto=$idProduto' class='button fit'> Minhas Mensagens </a>";
													}
												} 
											}
										}
								}
								
							}	
						}	
							
					?>			
					
				</div>
			</div>
		</div>
		</div>	

		<div class = "main" style = "height: auto; width: auto"></div>
		<!-- Footer -->
		<footer id    = "footer">
		<div    class = "inner">
				<h2>Troquei</h2>
				<ul class = "actions">
					<li>
						<span class = "icon fa-phone"> </span><a href = "#">(19) 99999-9999</a>
					</li>
					<li>
						<span class = "icon fa-envelope"> </span><a href = "#">sitetroquei@gmail.com</a>
					</li>
					<li>
						<span class = "icon fa-map-marker"> </span>Piracicaba, SP - Brasil
					</li>
				</ul>
			</div>
			<div class = "copyright">
				&copy; Projeto criado pela aluna Carolina Molinari.
			</div>
		</footer>
		<!-- Javascript -->
		<script type = "text/javascript" src = "assetsPerfil/plugins/jquery-1.11.1.min.js"></script>
		<script type = "text/javascript" src = "assetsPerfil/plugins/jquery-migrate-1.2.1.min.js"></script>
		<script type = "text/javascript" src = "assetsPerfil/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type = "text/javascript" src = "assetsPerfil/plugins/jquery-rss/dist/jquery.rss.min.js"></script>
		<script type = "text/javascript" src = "http://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>
		<script type = "text/javascript" src = "http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.js"></script>
		<script type = "text/javascript" src = "assetsPerfil/js/main.js"></script>

		<script src = "../assets/js/jquery.min.js"></script>
		<script src = "../assets/js/jquery.scrolly.min.js"></script>
		<script src = "../assets/js/skel.min.js"></script>
		<script src = "../assets/js/util.js"></script>
		<script src = "../assets/js/main.js"></script>

	</body>
</html>