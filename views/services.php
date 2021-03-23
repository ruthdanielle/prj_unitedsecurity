<?php
//chamada de cabeçalho
require_once "include/header.php";
?>

<section>
    <h1 class='titulo'>SERVIÇOS</h1>

    <?php

    if (isset($service)) : ?>
        <h3>Entre em contato conosco e solicite um orçamento sem compromisso</h3><br>

    <?php else : ?>
        <h3>Serviços não encontrados</h3><br>


    <?php endif;

    foreach ($service as $servc):?>
        <div class='wrapper'>
            <div class='produto'>
                <h2><?= $servc->nome ?></h2>
                <br><?= $servc->descricao ?> 
                <br><br> <img src="<?= url("/views/app/src/$servc->imagem") ?>">
            </div>
        </div>
    <?php endforeach  ?>

</section>

<?php
//chamada de rodapé
require_once "include/footer.php";
?>
