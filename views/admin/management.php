<?php
    //chamada de cabeçalho
    require_once __DIR__.'/../include/header.php';
?>

<section>
    <h1 class="titulo">Área do Administrador </h1>;

    <?php
    // calbacks 
    if (isset($data['areaalert'])) :

        $alert = base64_decode($data['areaalert']);
        
        switch ($alert) :
            case 'adminSuccess':?>
                <h2>Bem vindo <?= $_SESSION['usuario']->nome ?></h2>
            <?php break;
             case 'success':?>
                <h2>Dados atualizados com sucesso</h2>
            <?php break;


        endswitch;
    endif;
    ?>
    
</section>

<h3 >Ultimos contatos</h3>;

<section>


</section>

<div class="linkancora">
    <h3><a href="<?= url('usuario/area') ?>">Dados pessoais</a></h3>
    <h3><a href="<?= url('admin/area/promover') ?>">promover usuario</a></h3>
</div>

<?php
    //chamada de rodapé
    require_once __DIR__.'/../include/footer.php';
?>
