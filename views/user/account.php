<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>

<section>
    <h1 class="titulo">Dados Pessoais </h1>;

    <?php
    // calbacks 
    if (isset($data['areaalert'])) :

        $alert = base64_decode($data['areaalert']);
        
        switch ($alert):
            case 'userSuccess': ?>
                <h2>Bem vindo <?= $_SESSION['usuario']->nome ?></h2>
            <?php break;
            case 'success': ?>
                <h3>Dados atualizados com sucesso!</h3>
            <?php break;
        endswitch;
    endif;
    ?>

</section>

<section id="dados">

    <?php
    if (isset($_SESSION['usuario'])) : ?>

        <div class='dados'>
            <p>email cadastrado: <?= $_SESSION['usuario']->email ?></p>
            <p>Nome Completo: <?= $_SESSION['usuario']->nome ?></p>
            <p>CPF: <?= $_SESSION['usuario']->cpf ?></p>
            <p>Telefone: <?= $_SESSION['usuario']->telefone ?></p>
            <p>Cadastrado em: <?= date('d/m/Y', strtotime($_SESSION['usuario']->dtCadastro)) ?></p>
            <p>Ultima atualização cadastral em:
                <?= date('d/m/Y H:i', strtotime($_SESSION['usuario']->dtAtt)) ?></p>
            <p>Tipo de conta:
                <?= $_SESSION['usuario']->tipo ? 'Administrador(a)' : 'Standard' ?></p>
        </div>

    <?php else : ?>
        <h2 class="erro">Ooops Ocorreu um erro ao carregar</h2>

    <?php endif ?>

</section>

<div class="linkancora">
    <?php
    if ($_SESSION['usuario']->tipo) : ?>

        <h3><a href="<?= url('admin/area') ?>">Voltar</a></h3>

    <?php else : ?>

        <h3><a href="<?= url('usuario/area/servicos') ?>">Gerenciar serviços</a></h3>
    <?php endif; ?>

    <h3><a href="<?= url('usuario/area/atualizar') ?>">Atualizar dados</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
