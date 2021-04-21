
<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $title ?>United Security© </title>
    
    <link rel="stylesheet" href="<?= url("/views/app/css/style.css")?>">
    <script src="<?= url("/views/app/js/slider.js");?>"></script>


</head>

<body onload="slide1()">
    <div id="master">

        <header>

            <?php
                // Botão lateral login
                if (empty($_SESSION['usuario']->autenticado)):?>
                    <div class='login'><a href="<?= url('usuario/entrar');?>">Entre ou Cadastre-se</a></div>

                <?php else: ?>

                    <div class='login'><a href='<?= url('usuario/sair')?>'>Sair</a></div>
    
               <?php endif ?>
            
            

            <!-- logo do cabeçalho -->
            <div class="logo">
                <a href="<?= url()?>"><img src="<?= url("views/app/src/logo.png")?>" alt="United Security©" ></a>

                <h2 class="subtitulo">Maior segurança. A tecnologia à seu favor.</h2>
            </div>

            <br>

            <!-- Barra de navegação -->
            <?php
            
                if (empty($_SESSION['usuario']->autenticado)): ?>
			
			<div class="desktop-esconde menu-mobile">
				 <button class="botao-menu" onclick="abrirMenu()">
					 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="25px" height="25px" viewBox="0 0 459 459" style="enable-background:new 0 0 0 0;" fill="#ffffff" xml:space="preserve">
					<g>
						<g id="menu">
							<path d="M0,382.5h459v-51H0V382.5z M0,255h459v-51H0V255z M0,76.5v51h459v-51H0z"/>
						</g>
					</g>
					 </svg>
						
					</button>
			
			</div>
			
			<div id="menuMobile" class="menuLateral desktop-esconde">
				<div class="menu-alinhado">
					<h3>Menu</h3>
					 <a href="javascript:void(0)" onclick="fecharMenu()"><h1>&times;</h1></a>

				</div>
         
            
				<ul role="tablist"  class="lista-menu">
				    <li><a href="<?= url()?>">Início</a></li>
					<li><a href="<?=  url("servicos")?>"> Serviços</a></li>
					<li><a href="<?= url('contato') ?>"> Contato</a></li>
					<li><a href="<?= url('sobre')  ?>"> Sobre</a></li>
				</ul>
				
			</div>
			

                    <div class='menu mobile-esconde'>
                        <nav>
                            <ul>
                                <li><a href="<?= url()?>">Início</a></li>
                                <li><a href="<?=  url("servicos")?>"> Serviços</a></li>
                                <li><a href="<?= url('contato') ?>"> Contato</a></li>
                                <li><a href="<?= url('sobre')  ?>"> Sobre</a></li>
								

                            </ul>
                        </nav>
                    </div>

                    <?php elseif (isset($_SESSION['usuario']->autenticado) && ($_SESSION['usuario']->tipo == true)): ?>
			
			<div class="desktop-esconde menu-mobile">
				 <button class="botao-menu" onclick="abrirMenu()">
					 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="25px" height="25px" viewBox="0 0 459 459" style="enable-background:new 0 0 0 0;" fill="#ffffff" xml:space="preserve">
					<g>
						<g id="menu">
							<path d="M0,382.5h459v-51H0V382.5z M0,255h459v-51H0V255z M0,76.5v51h459v-51H0z"/>
						</g>
					</g>
					 </svg>
						
					</button>
			
			</div>
			
			<div id="menuMobile" class="menuLateral desktop-esconde">
				<div class="menu-alinhado">
					<h3>Menu</h3>
					 <a href="javascript:void(0)" onclick="fecharMenu()"><h1>&times;</h1></a>

				</div>
         
            
				<ul role="tablist"  class="lista-menu">
				     <li><a href="<?= url()?>">Início</a></li>
					<li><a href="<?= url("servicos")?>"> Serviços</a></li>
					<li><a href="<?= url('contato') ?>"> Contato</a></li>
					<li><a href="<?= url('sobre') ?>"> Sobre</a></li>
					<li><a href="<?= url('admin/area') ?>"> Administrar </a></li>
				</ul>
				
			</div>


                    <div class='menu2 menu-mobile2 mobile-esconde'>
                        <nav>
                            <ul>
                                <li><a href="<?= url()?>">Início</a></li>
                                <li><a href="<?= url("servicos")?>"> Serviços</a></li>
                                <li><a href="<?= url('contato') ?>"> Contato</a></li>
                                <li><a href="<?= url('sobre') ?>"> Sobre</a></li>
                                <li><a href="<?= url('admin/area') ?>"> Administrar </a></li>
                            </ul>
                        </nav>
                    </div>

 
                <?php else: ?>
			
			<div class="desktop-esconde menu-mobile">
				 <button class="botao-menu" onclick="abrirMenu()">
					 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="25px" height="25px" viewBox="0 0 459 459" style="enable-background:new 0 0 0 0;" fill="#ffffff" xml:space="preserve">
					<g>
						<g id="menu">
							<path d="M0,382.5h459v-51H0V382.5z M0,255h459v-51H0V255z M0,76.5v51h459v-51H0z"/>
						</g>
					</g>
					 </svg>
						
					</button>
			
			</div>
			
			<div id="menuMobile" class="menuLateral desktop-esconde">
				<div class="menu-alinhado">
					<h3>Menu</h3>
					 <a href="javascript:void(0)" onclick="fecharMenu()">&times;</a>

				</div>
         
            
				<ul role="tablist" class="lista-menu">
				     <li><a href="<?= url()?>">Início</a></li>
					<li><a href="<?= url("servicos")?>"> Serviços</a></li>
					<li><a href="<?= url('contato') ?>"> Contato</a></li>
					<li><a href="<?= url('sobre') ?>"> Sobre</a></li>
					<li><a href="<?= url('usuario/area') ?>"> Minha Área</a></li>
				</ul>
				
			</div>

                    <div class='menu2 menu-mobile2 mobile-esconde'>
                        <nav>
                            <ul>
                                <li><a href="<?= url()?>">Início</a></li>
                                <li><a href="<?= url("servicos")?>"> Serviços</a></li>
                                <li><a href="<?= url('contato') ?>"> Contato</a></li>
                                <li><a href="<?= url('sobre') ?>"> Sobre</a></li>
                                <li><a href="<?= url('usuario/area') ?>"> Minha Área</a></li>
                            </ul>
                        </nav>
                    </div>

                <?php endif ?>
          
        </header>  
		
		
		<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
