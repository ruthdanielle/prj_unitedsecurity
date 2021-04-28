<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Erro | United Security</title>
    
    <link rel="stylesheet" href="<?= url("/views/app/css/style.css")?>">
</head>

<body class="background-erro">
<div class="fundo-erro">
        <h1>
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
        <h2>Desculpe, ocorreu um erro. Clique no botão abaixo para voltar a navegar no sistema  </h2>
        <div class="conteudo">
            <h3><a href="<?= url() ?>" class="botao-erro">Voltar ao inicio</a></h3>
        </div>
    </div>

</body>

</html>



