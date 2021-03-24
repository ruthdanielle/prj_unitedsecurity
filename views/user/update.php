<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>


<h2 class="titulo">Atualize seus dados </h2>;


<?php
// calbacks 
if (isset($data['updatealert'])) :

    $alert = base64_decode($data['updatealert']);

    if ($alert == 'sucesso') : ?>
        <h3>Cadastro feito com sucesso! Faça seu login!</h3>
    <?php endif;

    if ($alert == 'updateerror') : ?>
        <h3 class="erro">Email e/ou senha incorretos. Por favor, tente novamente</h3>
<?php endif;
endif;
?>

<form class="cadastro" action="<?= url("usuario/area/atualizar") ?>" method="POST">
    <fieldset id="attField">
        <p>Atualização cadastral</p>

        <fieldset class="img_log centraliza">
            <legend>Preencha o formulario</legend>

            <label for="telAtt">Telefone<b>*</b>:</label>
            <input type="tel" id="telAtt" name="telAtt" placeholder="Somente Numeros" maxlength="11" required /><br>

            <label for="passwordAtt">Senha Atual<b>*</b>:</label>
            <input type="password" id="passwordAtt" name="passwordAtt" placeholder="Digite sua senha" required />

            <label for="passwordAtt2">Nova Senha<b>*</b>:</label>
            <input type="password" id="passwordAtt1" name="passwordAtt1" placeholder="Digite a nova senha" required />

            <label for="passwordAtt2"> Repetir Senha<b>*</b>:</label>
            <input type="password" id="passwordAtt2" name="passwordAtt2" placeholder="Repita a nova senha" required /><br>

            <input type="submit" value="Atualizar" id="atualizar" name="atualizar">

        </fieldset><br>

        <div class="linkancora centraliza">
            <h3><a href="<?= url('usuario/area/servicos') ?>">Clique aqui para gerenciar seus serviços</a></h3>
            
        </div>

    </fieldset>
</form>

<pre>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
