<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>


<h2 class="titulo">Gerenciar Serviços</h2>

<div class="dados-fundo">
<?php
// Area de alerta
if (isset($data['servicesalert'])) :

    $alert = base64_decode($data['servicesalert']);

    switch ($alert):
        case 'activeSuccess': ?>
            <h3>Serviço Ativado com Sucesso!</h3>
        <?php break;
        case 'activeError': ?>
            <h3 class="erro">Serviço ja contratado</h3>
        <?php break;
        case 'cancelSuccess': ?>
            <h3>Serviço cancelado com sucesso</h3>
        <?php break;
        case 'ServiceNotFound': ?>
            <h3 class="erro">Serviço não contratado ou ja cancelado</h3>
        <?php break;
        case 'cancelError': ?>
            <h3 class="erro">Erro ao Cancelar</h3>
        <?php break;
    endswitch;
endif;

?>

<section id='meusservicos'>

    

    <h1>Serviços Ativos</h1>

    <div class="dados">

        <?php
        //chamada de lista de serviços
        include_once __DIR__ . '/../include/list.php';
        ?>
        

    </div>
</section>

<section id='ativos'>

    <section id="contratar">
        <form action='<?= url("usuario/area/servicos") ?>' method='POST'>


            <h1>Ativar Serviços</h1>
            

            <div class='dados'>
                <select name='servico'>
                    <option disabled selected='true'>Selecione o serviço...</option>
                    <option value='1'>Biometria</option>
                    <option value='2'>Analise de Risco</option>
                    <option value='3'>Workshop</option>
                    <option value='4'>Serviços de Segurança</option>
                </select>
			</div>
            <input type='submit' value='Ativar' id='ativar' name='ativar'>

            
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

			</div>
                
			<input type='submit' value='Cancelar' id='cancela_servico' name='cancela_servico'>

            
        </form>
    </section>

</section>


<div class="alinhado">
    <h3><a href="<?= url('usuario/area/atualizar') ?>">Atualizar dados</a></h3>
    <h3><a href="<?= url('usuario/area') ?>">Minha Área</a></h3>
</div>
	
	</div>
	


<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
