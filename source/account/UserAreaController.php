<?php

namespace Source\account;

use CoffeeCode\Router\Router;

session_start();

class UserAreaController
{

    private $user;

    //Construtor verifica se o usuario autenticado é um usuario comun ou um administrador.
    public function __construct()
    {
        $this->user = $_SESSION['usuario'];
        if ((empty($this->user->autenticado) && $this->user->autenticado != true)) {
            $router = new Router(URL_BASE);
            $alert = base64_encode("accessonegado");
            $router->redirect("/ooops/{$alert}");
        }
    }

    //Rota da area do usuario tambem pode ser acessada para o administrador tratar dados pessoais.
    public function userArea($data)
    {
        //verifica quem esta tratando dados Usuario comun ou administrador e seta o titulo para cada situação.
        if (isset($_SESSION['usuario']) && ($_SESSION['usuario']->tipo == true)) {
            $title = 'GERENCIAR | ';
        } else {
            $title = 'MINHA AREA | ';
        }


        require __DIR__ . "/../../views/user/account.php";
    }

    //Rota de atualização cadastral.
    public function userUpdate()
    {
        $title = 'ATUALIZAR | ';
        require __DIR__ . "/../../views/user/update.php";
    }

    //Rota para gestão de serviços (contratação e cancelamentos).
    public function userServices()
    {
        $title = 'SERVIÇOS | ';
        require __DIR__ . "/../../views/user/management.php";
    }
}
