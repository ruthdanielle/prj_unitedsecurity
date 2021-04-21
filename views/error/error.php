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
                echo 'Erro ao atualizar!';
                break;
            default:
                echo $data["errcode"];
                break;
        }

    ?>
</h1>
<h2>Tente novamente mais tarde </h2>
<div class="conteudo">
	<h3><a href="<?= url() ?>" >Voltar ao inicio</a></h3>
</div>

