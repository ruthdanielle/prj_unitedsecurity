<?php
    //chamada de cabeçalho
    require_once __DIR__.'/../include/header.php';
?>

<pre>
    <?php
        print_r($_SESSION['usuario']);
    ?>
</pre>

<?php
    //chamada de rodapé
    require_once __DIR__.'/../include/footer.php';
?>
