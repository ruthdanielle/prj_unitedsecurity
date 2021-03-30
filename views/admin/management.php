<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>

<section>
    <h1 class="titulo">Área do Administrador </h1>;

    <?php
    // calbacks 
    if (isset($data['areaalert'])) :

        $alert = base64_decode($data['areaalert']);

        switch ($alert):
            case 'adminSuccess': ?>
                <h2>Bem vindo <?= $_SESSION['usuario']->nome ?></h2>
            <?php break;
            case 'success': ?>
                <h2>Dados atualizados com sucesso</h2>
            <?php break;
            case 'solve': ?>
                <h2>Marcado como resolvido!</h2>
            <?php break;

        endswitch;
    endif;
    ?>

</section>

<section id='meusservicos'>
    <h3>Ultimos contatos</h3>

    <?php

    // Lista contatos por data e situaçao
    foreach ($result as $item) : ?>
        <br>
        <?php if (!$item->situacao) : ?>

            <div class="dados">
                <form action="<?= url("admin/area") ?>" method="POST">
                    <p>Codigo:<?= $item->Id; ?> </p>
                    <p> assunto: <?= $item->assunto ?><br>
                        Nome: <?= $item->nome ?>
                        telefone: <?= $item->telefone ?><br>
                        email: <?= $item->email ?><br>
                        data: <?= date("d/m/Y", strtotime($item->dtContato)) . " às " . date("H:i", strtotime($item->dtContato)) ?><br><br>

                        mensagem: <br><?= $item->mensagem ?><br> <br>

                        <input type="hidden" name="idContato" value="<?= $item->Id ?>">
                        <button type="submit">respondido</button>
                    </p>
                </form>
            </div>

        <?php else : ?>
            <div class="dados">
                <p>Codigo: <?= $item->Id; ?> <span style="text-align: right; float:right;">RESOLVIDO</span> </p>
                <p> assunto: <?= $item->assunto ?><br>
                    Nome: <?= $item->nome ?>
                    telefone: <?= $item->telefone ?><br>
                    email: <?= $item->email ?><br>
                    data: <?= date("d/m/Y", strtotime($item->dtContato)) . " às " . date("H:i", strtotime($item->dtContato)) ?><br><br>

                    mensagem: <br><?= $item->mensagem ?><br> <br>
                </p>
            </div>

    <?php endif;
    endforeach; ?>

</section>

<div class="linkancora">
    <h3><a href="<?= url('usuario/area') ?>">Dados pessoais</a></h3>
    <h3><a href="<?= url('admin/area/promover') ?>">promover usuario</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
