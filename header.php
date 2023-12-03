<header id="header">
			<nav class="left">
				<a href="#menu"><span>Menu</span></a>
				<?php
					if (isset($_SESSION['user'])) {
					$nomeCliente = $_SESSION['nome'];
					$nome = current( str_word_count( $nomeCliente , 2 ) );
					print "<nav id='menu'>
								<ul class='links'>
							<li>
								<a href='cliente/perfil.php' class='button alt' style='margin-top: 27px;'>$nome</a>
                                <a href='produtosCliente.php' class='button alt' style='margin-top: 27px; margin-top: 10px;'>Meus Produtos</a>
                                <a href='login/logout.php' class='button alt' style='margin-top: 27px; margin-top: 10px;'>Sair</a>
								</li>
							
							<li>
								<a href='listagem.php'>Todos os Produtos</a>
							</li>
							<li>
								<a href='acessorios.php'>Acessorios</a>
							</li>
							<li>
								<a href='deco.php'>Decoração</a>
							</li>
							<li>
								<a href='eletronicos.php'>Eletrônicos</a>
							</li>
							<li>
								<a href='jogos.php'>Jogos</a>
							</li>
							<li>
								<a href='livros.php'>Livros</a>
							</li>
							<li>
							<a href='sobre.php'>Sobre Nós</a>
							</li>
				
						</ul>
						</nav>";
					}
					else{
						print "<nav id='menu'>
								<ul class='links'>
							
							<li>
								<a href='listagem.php'>Todos os Produtos</a>
							</li>
							<li>
								<a href='acessorios.php'>Acessorios</a>
							</li>
							<li>
								<a href='deco.php'>Decoração</a>
							</li>
							<li>
								<a href='eletronicos.php'>Eletrônicos</a>
							</li>
							<li>
								<a href='jogos.php'>Jogos</a>
							</li>
							<li>
								<a href='livros.php'>Livros</a>
							</li>
							<li>
							<a href='sobre.php'>Sobre Nós</a>
							</li>
				
						</ul>
						</nav>";
					}

				?>
			</nav>
			<a href='index.php'><img id='logoTroquei' src='images/troquei.png' height='85px' width = '145px'></a>	
		
			<?php
			if (isset($_SESSION['user'])) {
				$nomeCliente = $_SESSION['nome'];
				$nome = current(str_word_count($nomeCliente, 2));

				print "<form method='post' action = 'pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
				<input type='text' name='pesquisa' style='width:560px; margin-left: -10px;  margin-right: 10px;'/>
				<button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 565px; margin-top: -40px;'>
					Pesquisar
				</button>
				</form>";

				print "<nav class='right'>
				<a href='cliente/cadastrarProduto.php' class='button alt' style='margin-top: 20px;'>Cadastrar Produto</a>
				<a href='cliente/solicitacaoTroca.php' class='button alt' style='margin-top: 27px;'>Solicitação de Troca</a>
				</nav>";

			} else {
				print "<form method='post' action = 'pesquisa.php' style='width: 900px; margin: auto; margin-top: 30px;'>
				<input type='text' name='pesquisa' style='width:600px; margin-left: 110px; margin-right: 10px;'/>
				<button type='submit' id='botaoPesquisar' class='button fit' style='font-size: 10px; width: 100px; height: 40px; margin-left: 725px; margin-top: -40px;'>
					Pesquisar
				</button>
			</form>";
				print "<nav class='right'>
				<a href='login/login.php' class='button alt' style='margin-top: 27px;'>Entrar</a>
				<a href='cliente/criarConta.php' class='button alt' style='margin-top: 27px;'>Criar conta</a>
			</nav>";
			}
			?>
		</header>