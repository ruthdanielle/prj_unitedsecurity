<?php
ob_start();
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>


<h1 class='titulo'>Login</h1>
<div class="conteudo">
<form id="LogIn" action="<?= url("usuario/entrar");?>" method="POST">

    

    <?php
    // Area de alerta
    if (isset($data['loginalert'])) :

        $alert = base64_decode($data['loginalert']);

        switch ($alert):
            case 'sucesso': ?>
                <h3>Cadastro feito com sucesso! Faça seu login!</h3>
            <?php break;
            case 'loginerror': ?>
                <h3 class="erro">Email e/ou senha incorretos. Por favor, tente novamente</h3>
            <?php break;
        endswitch;
    endif;
    ?>

    <fieldset class="contatos">
        <img id="logologin" src="<?=url('views/app/src/logo.png')?>" alt="United Security©">
        <p>Use sua conta United</p>
		<div class="justify">
			<label for="username">Email<b>*</b>:</label>
			<input type="text" id="email" name="email" placeholder="Digite seu apelido" required />
			<br>
		</div>
		
		<div class="justify">
			<label for="password">Senha<b>*</b>:</label>
			<input type="password" id="password" name="password" placeholder="Digite sua Senha" required><br>
		</div>
		<div class="alinhado">
			<a id="aCadastro" href="<?=url('usuario/cadastrar')?>">Cadastre-se!</a>
			<input type="submit" value="Login" id="logar" class="entrar" name="logar">
		</div>
    </fieldset>

</form>
</div>
<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';


?>
