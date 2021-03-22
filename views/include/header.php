
<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= $title ?>United Security© </title>
    
    <link rel="stylesheet" href="<?= url("/views/app/css/style.css")?>">
    <script src="<?= url("/views/app/js/slider.js");?>"></script>


</head>

<body onload="slide1()">
    <div id="master">

        <header>

            <?php
                // Botão lateral login
                if (empty($_SESSION['usuario']->autenticado)):?>
                    <div class='login'><a href="<?= url('usuario/entrar');?>">Entre ou Cadastre-se</a></div>

                <?php else: ?>

                    <div class='login'><a href='<?= url('usuario/sair')?>'>Sair</a></div>
    
               <?php endif ?>
            
            

            <!-- logo do cabeçalho -->
            <div class="logo">
                <a href="<?= url()?>"><img src="<?= url("views/app/src/logo.png")?>" alt="United Security©"></a>

                <h2 class="subtitulo">Maior segurança. A tecnologia à seu favor.</h2>
            </div>

            <br>

            <!-- Barra de navegação -->
            <?php
            
                if (empty($_SESSION['usuario']->autenticado)): ?>

                    <div class='menu'>
                        <nav>
                            <ul>
                                <li><a href="<?= url()?>">Início</a></li>
                                <li><a href="<?=  url("servicos")?>"> Serviços</a></li>
                                <li><a href="<?= url('contato') ?>"> Contato</a></li>
                                <li><a href="<?= url('sobre')  ?>"> Sobre</a></li>

                            </ul>
                        </nav>
                    </div>

                    <?php elseif (isset($_SESSION['usuario']->autenticado) && ($_SESSION['usuario']->tipo == true)): ?>

                    <div class='menu2'>
                        <nav>
                            <ul>
                                <li><a href="<?= url()?>">Início</a></li>
                                <li><a href="<?= url("servicos")?>"> Serviços</a></li>
                                <li><a href="<?= url('contato') ?>"> Contato</a></li>
                                <li><a href="<?= url('sobre') ?>"> Sobre</a></li>
                                <li><a href="<?= url('admin/area') ?>"> Administrar </a></li>
                            </ul>
                        </nav>
                    </div>

 
                <?php else: ?>

                    <div class='menu2'>
                        <nav>
                            <ul>
                                <li><a href="<?= url()?>">Início</a></li>
                                <li><a href="<?= url("servicos")?>"> Serviços</a></li>
                                <li><a href="<?= url('contato') ?>"> Contato</a></li>
                                <li><a href="<?= url('sobre') ?>"> Sobre</a></li>
                                <li><a href="<?= url('usuario/area') ?>"> Minha Área</a></li>
                            </ul>
                        </nav>
                    </div>

                <?php endif ?>
          
        </header>   