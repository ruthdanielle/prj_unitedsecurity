<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>

<form id="LogIn" action="<?= url("usuario/entrar") ?>" method="POST">

    <h1 class='titulo'>Login</h1>

    <?php
    // calbacks 
    if (isset($data['loginalert'])) :

        $alert = base64_decode($data['loginalert']);

        if ($alert == 'sucesso') : ?>
            <h3>Cadastro feito com sucesso! Faça seu login!</h3>
        <?php endif;

        if ($alert == 'loginerror') : ?>
            <h3 class="erro">Email e/ou senha incorretos. Por favor, tente novamente</h3>
    <?php endif;


    endif;
    ?>

    <fieldset class="contatos">
        <img id="logologin" src="<?= url("views/app/src/logo.png") ?>" alt="United Security©">
        <p>Use sua conta United</p>

        <label for="username">Email<b>*</b>:</label>
        <input type="text" id="email" name="email" placeholder="Digite seu apelido" required />
        <br>

        <label for="password">Senha<b>*</b>:</label>
        <input type="password" id="password" name="password" placeholder="Digite sua Senha" required><br>
        <input type="submit" value="Login" id="logar" name="logar">


        <a id="aCadastro" href="<?= url('usuario/cadastrar') ?>">Cadastre-se!</a>
    </fieldset>

</form>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
