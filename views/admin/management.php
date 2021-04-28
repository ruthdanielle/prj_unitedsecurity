<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>

<div>
    <h1 class="titulo">Área do Administrador </h1>

    <?php
    // calbacks 
    if (isset($data['areaalert'])) :

        $alert = base64_decode($data['areaalert']);

        switch ($alert):
            case 'adminSuccess': ?>
                <h2>Olá, <?= $_SESSION['usuario']->nome ?></h2>
            <?php break;
            case 'success': ?>
                <h2 style="color: green">Dados atualizados com sucesso</h2>
            <?php break;
            case 'solve': ?>
                <h2 style="color: green">Resolvido!</h2>
            <?php break;

        endswitch;
    endif;
    ?>

</div>

<section id='meusservicos' >
    <h3>Últimos contatos</h3>

    <?php

    // Lista contatos por data e situaçao
    foreach ($result as $item) : ?>
        <br>
        <?php if (!$item->situacao) : ?>

           
                <form action="<?= url("admin/area") ?>" method="POST">
                <div class="dados">
                    <p><b>Código:</b> <?= $item->Id; ?> </p>
                    <p><b>Assunto:</b> <?= $item->assunto ?> </p>
                    <p><b>Nome:</b> <?= $item->nome ?> </p>
                    <p><b>Telefone:</b> <?= $item->telefone ?> </p>
                    <p><b>Email:</b> <?= $item->email ?> </p>
                    <p><b>Data:</b> <?= date("d/m/Y", strtotime($item->dtContato)) . " às " . date("H:i", strtotime($item->dtContato)) ?></p>

                    <p> <b>Mensagem:</b> <?= $item->mensagem ?> </p>

                        <input type="hidden" name="idContato" value="<?= $item->Id ?>"> 
                    <p style="display: flex; justify-content:center">  <button type="submit" class="entrar" style="border: 0 !important;">Responder</button></p>
                    
                </div>
                </form>
            

        <?php else : ?>
            <div class="dados">
                <p><b>Código:</b> <?= $item->Id; ?> </p>
                <p><b>Assunto:</b> <?= $item->assunto ?> </p>
                <p><b>Nome:</b> <?= $item->nome ?> </p>
                <p><b>Telefone:</b> <?= $item->telefone ?> </p>
                <p><b>Email:</b> <?= $item->email ?> </p>
                <p><b>Data:</b> <?= date("d/m/Y", strtotime($item->dtContato)) . " às " . date("H:i", strtotime($item->dtContato)) ?></p>

                <p><b>Mensagem:</b> <?= $item->mensagem ?> </p>

                <p class="resolvido"><b>RESOLVIDO</b></button></p>
                
            </div>

    <?php endif;
    endforeach; ?>

</section>

<div class="alinhado margem">
    <h3><a href="<?= url('usuario/area') ?>">Dados pessoais</a></h3>
    <h3><a href="<?= url('admin/area/promover') ?>">Promover usuario</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
