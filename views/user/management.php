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

<section id='ativos'>

    <section id="contratar">
        <form action='<?= url("usuario/area/servicos") ?>' method='POST'>


            <h1>Ativar Serviços</h1>
            <br>

            <div class='dados'>
                <select name='servico'>
                    <option disabled selected='true'>Selecione o serviço...</option>
                    <option value='1'>Biometria</option>
                    <option value='2'>Analise de Risco</option>
                    <option value='3'>Workshop</option>
                    <option value='4'>Serviços de Segurança</option>
                </select>

                <br><br>
                <input type='submit' value='Ativar' id='ativar' name='ativar'>

            </div>
        </form>
    </section>


    <section id="cancelar">

        <form action='<?= url("usuario/area/servicos") ?>' method='POST'>


            <h1>Cancelar Serviço</h1>


            <div class='dados'>
                <select name='servico'>
                    <option disabled selected='true'>Selecione o serviço...</option>
                    <option value='1'>Biometria</option>
                    <option value='2'>Analise de Risco</option>
                    <option value='3'>Workshop</option>
                    <option value='4'>Serviços de Segurança</option>
                </select>

                <br><br>
                <input type='submit' value='Cancelar' id='cancela_servico' name='cancela_servico'>

            </div>
        </form>
    </section>

</section>


<div class="linkancora">
    <h3><a href="<?= url('usuario/area/atualizar') ?>">Atualizar dados</a></h3>
    <h3><a href="<?= url('usuario/area') ?>">Minha Area</a></h3>
</div>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
