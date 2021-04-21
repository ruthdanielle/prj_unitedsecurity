<?php
//chamada de cabeçalho
require_once "include/header.php";
?>


<!-- slider carrosel -->
<section>
    <div id="slider"> <img id="id"></div>
</section>



<div class="content">
    <h1 class="titulo">United Security©</h1>
    <h3>Maior seurança. A tecnologia a seu favor</h3>

    <p>A United Security visa contribuir com seus serviços personalizados de
        acordo com o cliente e suas
        necessidades da melhor forma possível, tornando a experiência de 
        consultoria e aplicação de procedimentos de
        segurança da informação lógicos (Segurança Lógica Atenta contra ameaças 
        ocasionadas por vírus, acessos remotos à rede,
        backup desatualizados, violação de senhas, furtos de identidades, etc.) 
        o melhor do mercado.</p>
</div>


<div class="content">
    <h1 class="titulo">Serviços Prestados</h1>
	<div class="conteudo1">
		<div class="content ">
			<a href="<?= url("servicos") ?>">
				<img src="<?= url('/views/app/src/biometria.jpeg') ?>" alt="Controle Biometrico" class="img-responsive">
			</a>
		</div>

		<div class="content">
			<a href="<?= url("servicos") ?>">
				<img src="<?= url('/views/app/src/analise.png') ?>" alt="Analise de Risco" class="img-responsive">
			</a>
		</div>
	</div>
	<div class="conteudo2">
		<div class="content">
			<a href="<?= url("servicos") ?>">
				<img src="<?= url('/views/app/src/workshop.jpg') ?>" alt="Workshop" class="img-responsive">
			</a>
		</div>
		<div class="content">
			<a href="<?= url("servicos") ?>">
				<img src="<?= url('/views/app/src/servicoseguranca.jpg') ?>" alt="Segurança" class="img-responsive">
			</a>
		</div>
	</div>
</div>


<?php
//chamada de rodapé
require_once "include/footer.php";
?>
