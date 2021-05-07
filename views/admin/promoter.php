<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>
<h1>Promover</h1>

<div class="dados-fundo">

<!-- Formulario de busca -->
<form action="<?= url("admin/area/promover") ?>" method="get">


    <h3>Buscar e Alterar tipo de conta</h3>

    <?php
    // ALERTAS
    if (isset($data['promoteralert'])) :
        $alert = base64_decode($data['promoteralert']);
        switch ($alert):
            case 'invalidemail': ?>
                <h3 class="erro">E-mail inválido</h3>
            <?php break;
            case 'NaN': ?>
                <h3 class="erro">Digite apenas números para CPF</h3>
            <?php break;
            case 'noresult': ?>
                <h3 class="erro">Não foram encontrados registros</h3>
            <?php break;

            case 'upfail': ?>
                <h3 class="erro">Não foi possível alterar</h3>
            <?php break;
            case 'upsuccess': ?>
                <h3>Conta alterada com sucesso</h3>
            <?php break;
            case 'selecione': ?>
                <H3>Selecione uma conta para altera-la</H3>
            <?php break;

        endswitch;
    endif;
    ?>

<div class="busca-promotor">

    
    <label for="buscarpor">Buscar por:</label>
    
    <select name="buscarpor" id="buscarpor">
        <option value="email">E-MAIL</option>
        <option value="cpf">CPF</option>

    </select>
    
    <input type="text" placeholder="Digite para buscar" name="busca" id="busca" required>

    <button type="submit" name="buscar">Pesquisar</button>

    
</div>
</form>

<!-- Formulario de alteraçao de tipo de conta -->
<div class="dados">

    <form action="<?= url("admin/area/promover") ?>" method="POST">
        <?php

        if (isset($user)) :

            foreach ($user as $line) : ?>

                <br>
                <div id="bloco">

                    <p>Código:<?= $line->Id ?> </p>
                    <p>Nome: <?= $line->nome ?></p>
                    <p>CPF: <?= $line->cpf ?></p>
                    <p>Telefone: <?= $line->telefone ?></p>
                    <p>E-mail: <?= $line->email ?></p>
                    <p>Tipo: <?= $line->tipo ? "Administrador" : "Padrão" ?></p>

                    <p> <input type="radio" name="select" id="select" value="<?= $line->Id ?>">  </p>
                   
                </div>
                

            <?php endforeach; ?>
            <div class="margem-top busca-promotor">
                <select name="promo" id="promo">
                    <option value="1">Administrador</option>
                    <option value="null">Padrão</option>
                </select>
            
            <button type="submit" class='entrar'>Atualizar</button>
            </div>
        <?php endif; ?>
    
    </form>
</div>

<div style="margin-top: 2rem">
    <h3><a href="<?= url('admin/area') ?>">Voltar</a></h3>
</div>

</div>
<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
