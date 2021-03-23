<?php
    //chamada de cabeçalho
    require_once __DIR__.'/../include/header.php';
?>




<h2 class="titulo">Atualize seus dados </h2>;


<?php 
    // callback area
if (isset($_GET['atualiza']) && $_GET['atualiza'] == 'sucesso') {
    echo "<h3>Dados Alterados com Sucesso</h3>";
}     ?>





<br><br>
<div class="linkancora">
    <h3><a href="<?= url('usuario/area/servicos')?>">Clique aqui para gerenciar seus serviços</a></h3>
    <h3><a href="<?= url('usuario/area')?>">Voltar para Minha Area</a></h3>
</div>




<?php
    //chamada de rodapé
    require_once __DIR__.'/../include/footer.php';
?>
