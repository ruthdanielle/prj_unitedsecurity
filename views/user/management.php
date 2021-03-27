<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>





<h2 class="titulo">Gerir Serviços de <?= $_SESSION['usuario']->nome; ?> </h2>

<section id='meusservicos'>

    <br>

    <h1>Serviços Ativos</h1>

    <div class="dados">

        <?php
        //chamada de lista de serviços
        include_once __DIR__ . '/../include/list.php';
        ?>
        <br>

    </div>
</section>


<div class="linkancora">
    <h3><a href="<?= url('usuario/area/atualizar') ?>">Atualizar dados</a></h3>
    <h3><a href="<?= url('usuario/area') ?>">Minha Area</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
