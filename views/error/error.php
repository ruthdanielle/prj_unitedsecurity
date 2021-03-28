<?php
//chamada de cabeçalho
require_once __DIR__ . '/../include/header.php';
?>
<br>
<h1>Ops! um erro foi detectado:
    <?php

        $alert = base64_decode($data["errcode"]);
        switch ($alert) {
            case 'connecterror':
                echo 'Erro de conexão com a base de dados';
                break;
            case 'accessonegado':
                echo 'Acesso negado';
                break;
            case 'searcherror':
                echo 'Erro ao atualiza!';
                break;
            default:
                echo $data["errcode"];
                break;
        }

    ?>
</h1>
<h2>Tente novamente mais tarde <a href="<?= url() ?>">voltar ao inicio</a></h2>

<?php
//chamada de rodapé
require_once __DIR__ . '/../include/footer.php';
?>
