<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>
<br>
<h1>Ops! um erro foi detectado:
    <?php

    if (base64_decode($data["errcode"]) == 'connecterror') :
        echo 'Erro de conexão com o banco de dados';
    elseif (base64_decode($data["errcode"]) == 'accessonegado') :
        echo 'Acesso negado';
    else :
        echo $data["errcode"];
    endif;

    ?>
</h1>
<h2>Tente novamente mais tarde <a href="<?= URL_BASE ?>">voltar ao inicio</a></h2>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
