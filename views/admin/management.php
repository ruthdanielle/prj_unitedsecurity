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
    <div class="dados">
        <?php
        
        // Lista contatos por data e situaçao
        foreach ($result as $item) :
            if (!$item[7]) : ?>

                <form action="<?= url("admin/area") ?>" method="POST">
                    <p>Codigo:<?= $item[0]; ?> </p>
                    <p> assunto: <?= $item[4] ?><br>
                        Nome: <?= $item[1] ?>
                        telefone: <?= $item[2] ?><br>
                        email: <?= $item[3] ?><br>
                        data: <?= date("d/m/Y", strtotime($item[6]))." às ".date("H:i", strtotime($item[6]))?><br><br>

                        mensagem: <br><?= $item[5] ?><br> <br>

                        <input type="hidden" name="idContato" value="<?= $item[0]; ?>">
                        <button type="submit">respondido</button>
                    </p>
         
            <?php else :?>
    
                    <p>Codigo: <?= $item[0]; ?>  <span style="text-align: right; float:right;">RESOLVIDO</span> </p>
                    <p> assunto: <?= $item[4]?><br>
                        Nome: <?= $item[1] ?>
                        telefone: <?= $item[2] ?><br>
                        email: <?= $item[3] ?><br>
                        data: <?= date("d/m/Y", strtotime($item[6]))." às ".date("H:i", strtotime($item[6]))?><br><br>

                        mensagem: <br><?= $item[5] ?><br> <br>               
                    </p>
                
        <?php endif;
        endforeach; ?>
    </div>
       </form>
</section>

<div class="linkancora">
    <h3><a href="<?= url('usuario/area') ?>">Dados pessoais</a></h3>
    <h3><a href="<?= url('admin/area/promover') ?>">promover usuario</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
