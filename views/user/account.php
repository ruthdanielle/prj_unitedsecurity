<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>

<section>
    <h1 class="titulo">Área do Usuario </h1>;
    <h2>Bem vindo <?= $_SESSION['usuario']->nome ?></h2>
</section>

<section id="dados">

    <?php
    if (isset($_SESSION['usuario'])) : ?>

        <div class='dados'>
            <p>email cadastrado: <?= $_SESSION['usuario']->email ?></p>
            <p>Nome Completo: <?= $_SESSION['usuario']->nome ?></p>
            <p>CPF: <?= $_SESSION['usuario']->cpf ?></p>
            <p>Telefone: <?= $_SESSION['usuario']->telefone ?></p>
            <p>Ultima atualização cadastral em:
                <?= date('d/m/Y H:i', strtotime($_SESSION['usuario']->dtAtt)) ?></p>
        </div>

    <?php else : ?>
        <h2 class="erro">Ooops Ocorreu um erro ao carregar</h2>

    <?php endif ?>

</section>

<div class="linkancora">
    <h3><a href="<?= url('usuario/area/servicos')?>">Clique aqui para gerenciar seus serviços</a></h3>
    <h3><a href="<?= url('usuario/area/atualizar')?>">Clique aqui para atualizar seus dados</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
