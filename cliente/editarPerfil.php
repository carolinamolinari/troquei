<?php
	
	session_start();
	$cpf = $_SESSION['cpf'];
	$nomeCliente = $_SESSION['nome'];
	$cidadeCliente = $_SESSION['cidade'];
	$dataNascimentoCliente = $_SESSION['dataNascimento'];
	$estadoCliente = $_SESSION['estado'];
	$emailCliente = $_SESSION['email'];
	$enderecoCliente = $_SESSION['endereco'];
	
	
?>

<!DOCTYPE HTML>

<html lang = 'pt-br'>
	<head>
		<title>Troquei - Editar Perfil</title>
		<meta charset="utf-8" />	
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Responsive HTML5 Website landing Page for Developers">
		<meta name="author" content="3rd Wave Media">
		<link rel="shortcut icon" href="../favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="assetsPerfil/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="assetsPerfil/plugins/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
		<link rel="stylesheet" href="http://caseyscarborough.github.io/github-activity/github-activity-0.1.0.min.css">	
		<link id="theme-style" rel="stylesheet" href="assetsPerfil/css/styles.css">
		

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/js/jquery-ui.css">
  		<script src="../assets/js/jquery-1.12.4.js"></script>
  		<script src="../assets/js/jquery-ui.js"></script>
  		<script type="text/javascript">

  		 	var $j = jQuery.noConflict();
			jQuery(function($j){
			$j.datepicker.regional['pt-BR'] = {
				closeText: 'Fechar',
				prevText: '&#x3C;Anterior',
				nextText: 'Próximo&#x3E;',
				currentText: 'Hoje',
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				dayNames: ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
				dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
				weekHeader: 'Sm',
				dateFormat: 'dd/mm/yy',
				firstDay: 0,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$j.datepicker.setDefaults($j.datepicker.regional['pt-BR']);
		});
  	</script>
  
  <script>
  $j( function() {
   
	$j("#datepicker").datepicker({
		changeMonth: true,
		changeYear: true
	});
    
  } );
  </script>
		<script type="text/javascript">
			function formatar_mascara(src, mascara) {
 			var campo = src.value.length;
 			var saida = mascara.substring(0,1);
 			var texto = mascara.substring(campo);
 			if(texto.substring(0,1) != saida) {
 			src.value += texto.substring(0,1);
 			}
		}
		
</script>
<script type="text/javascript" src="../assets/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript">	
		
		$(document).ready(function () {
		
			$.getJSON('estados_cidades.json', function (data) {
				var items = [];
				var options = '<option value="">Escolha um estado</option>';	
				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					
				$("#estadoCliente").html(options);				
				
				$("#estadoCliente").change(function () {				
				
					var options_cidades = '';
					var str = "";					
					
					$("#estadoCliente option:selected").each(function () {
						str += $(this).text();
					});
					
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.cidades, function (key_city, val_city) {
								options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});
					$("#cidadeCliente").html(options_cidades);
					
					$("#cidadeCliente").val('<?php print $cidadeCliente; ?>');
					
				}).change();
				
				$("#estadoCliente").val('<?php print $estadoCliente; ?>');
				$("#estadoCliente").change();
			
			});	
		
		});
		
	</script>		
	</head>
	<body>

		<!-- Header -->
		<header id="header">
			<a href='../index.php'><img src='../images/troquei.png' height='85px' width = '145px'></a>	
			<nav class="right">
				<input type='button' value='Voltar' onClick='history.go(-1)'>
			</nav>
		</header>
		
		<!-- Cadastro -->
		<div class="cadastro" style="width: 500px; height: 1000px; margin: auto;">
			<?php
				
				if(isset($_GET['error'])){
					print "<span style='color:red; font-weight: bold; font-size: 20px;'>Erro ao atualizar conta! Certifique-se de que inseriu seu CPF para confirmar a ação!</span>";
				}
			
			?>
			<form method="post" enctype="multipart/form-data" action="salvaEdita.php" >
				<p style="font-family: 'Open Sans', Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; font-size: 15px; margin-bottom: 5px;">
					Informações Pessoais:
				</p><br>
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Nome:</label>
				<input type="text" name="nomeCliente" value="<?php print $nomeCliente; ?>"/>
				<br>
				<label style="width: 150px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Data de Nascimento:</label>
				<input type="text" name="dataNascimentoCliente" value="<?php print $dataNascimentoCliente; ?>" id='datepicker'/>
				<br>
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Endereço:</label>
				<input type="text" name="enderecoCliente" value="<?php print $enderecoCliente; ?>" />
				<br>
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Estado:</label>
				<select id="estadoCliente" name="estadoCliente">
					<option value=''></option>
				</select><br>
				<label style="width: 90px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Cidade:</label>
				<select id="cidadeCliente" name="cidadeCliente" >
				</select><br>
								
				<label style="width: 300px; height: 2px; display: inline-block;
				color: black; font-family: 'Open Sans', Arial, Helvetica, sans-serif; size: 15px;">Selecione uma imagem para perfil: (Opicional)</label>
				<input name="arquivo" type="file"/>
				<br>
				
				<p style="font-family: 'Lato', arial, sans-serif; font-weight: bold; color: #000000; font-size: 15px; margin-bottom: 5px;">
					Informe CPF para confirmar:
				</p><br>
				
				<input type="text" maxlength="14" name="cpfCliente">
				
				<button type="submit" id="Salvar" class="button fit" style='margin-top: 10px;'>
					Atualizar
				</button>
			</form>
		</div>

		<!-- Scripts -->
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