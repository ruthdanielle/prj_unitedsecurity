<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>
<h1>Promover</h1>

<!-- Formulario de busca -->
<form action="<?= url("admin/area/promover") ?>" method="get">
    
    
    <h3>Buscar e Alterar tipo de conta</h3>

        <?php
        // ALERTAS
        if (isset($data['promoteralert'])) :
            $alert = base64_decode($data['promoteralert']);
            switch ($alert):
                case 'invalidemail': ?>
                    <H3 class="erro">Email invalido</H3>
                <?php break;
                case 'NaN': ?>
                    <H3 class="erro">Em CPF digite apenas numeros</H3>
        <?php break;
                case 'noresult': ?>
                    <H3 class="erro">Não foram encontrados registros</H3>
        <?php break;

            endswitch;
        endif;
        ?>


    <label for="buscarpor">Buscar por:</label>

    <select name="buscarpor" id="buscarpor">
        <option value="email">EMAIL</option>
        <option value="cpf">CPF</option>
        
    </select>

    <input type="text" placeholder="digite para buscar" name="busca" id="busca" required>

    <button type="submit" name="buscar">Pesquisar</button>

</form>

<!-- Formulario de alteraçao de tipo de conta -->
<div class="dados">

   <form action="<?= url("admin/area/promover") ?>" method="POST">
        <?php
    
        if (isset($user)) :
    
            foreach ($user as $line) : ?>

                <br>
                <div id="bloco">

                    <p>Codigo:<?= $line->Id ?> </p>
                    <p> Nome: <?= $line->nome ?><br>
                        Cpf: <?= $line->cpf ?><br>
                        telefone: <?= $line->telefone ?><br>
                        email: <?= $line->email ?><br>
                        tipo: <?= $line->tipo ? "Administrador" : "Standard" ?><br><br>

                        <input type="radio" name="select" id="select" value="<?= $line->Id ?>">
                    </p>
                </div>
                <br>
            
            <?php endforeach; ?>

                <select name="promo" id="promo">
                    <option value="1">Admin</option>
                    <option value="0">Standard</option>
                </select>
                <button type="submit">Atualizar</button>
    </form>

    <?php endif; ?>
</div>

<div class="linkancora">
    <h3><a href="<?= url('admin/area') ?>">Voltar</a></h3>
</div>
<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
