<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>

<h1 class='titulo'>Cadastre-se</h1>

<?php
// callback area   
if (isset($data['registeralert'])) :

    $alert = base64_decode($data['registeralert']);

    switch ($alert):
        case 'emailerror': ?>
            <h4 class='erro'>Email já cadastrado</h4>
        <?php break;
        case 'cpferror': ?>
            <h4 class='erro'>Cpf já cadastrado</h4>
        <?php break;
        case 'interror': ?>
            <h4 class='erro'>Prencha apenas numeros nos campos CPF e TELEFONE</h4>
        <?php break;
    endswitch;
endif;
?>


<form id="cadastro" action="<?= url("usuario/cadastrar") ?>" method="POST">
    <fieldset>

        <br>
        <p>Preencha o Formulário a seguir</p><br>


        <fieldset id="img_pessoal">
            <legend>Dados Pessoais</legend>

            <label for="name">Nome<b>*</b>:</label>
            <input type="text" id="name" name="name" placeholder="Digite seu nome completo" required />
            <div id="vdNome"></div><br>

            <label for="cpf">CPF<b>*</b>:</label>
            <input type="text" id="cpf" name="cpf" placeholder="Digite somente números" maxlength="11" required />
            <div id="vdCpf"></div><br>

            <label for="tel">Telefone<b>*</b>:</label>
            <input type="tel" id="tel" name="tel" placeholder="Somente Numeros" maxlength="14" required /><br>

        </fieldset>

        <fieldset class="img_log">
            <legend>Dados para Login</legend>

            <label for="nick">E-mail<b>*</b>:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required />
            <div id="vdNick"></div><br>

            <label for="password">Senha<b>*</b>:</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required />
            <div id="vdPass"></div>

            <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">

        </fieldset><br>


    </fieldset>
</form>


<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>