<?php

namespace Source\account;

use CoffeeCode\Router\Router;
use Data\Models\Dao\ServicoContratadoDao;
use Data\Models\Dao\UserDao;

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
        if (isset($this->user) && ($this->user->tipo == true)) {
            $title = 'GERENCIAR | ';
        } else {
            $title = 'MINHA AREA | ';
        }


        require __DIR__ . "/../../views/user/account.php";
    }

    //Rota de atualização cadastral.
    public function userUpdate($data)
    {
        
        $title = 'ATUALIZAR | ';
        require __DIR__ . "/../../views/user/update.php";

        if (isset($_POST['atualizar'])) {

            if (empty($data['telAtt'])) {
                $data['telAtt'] = $this->user->telefone;
            }

            $dao = new UserDao();
            $alert = $dao->att($this->user->Id, $data);
        }
        //Verifica se a mensagem foi disparada e redireciona para cada situação
        $router = new Router(URL_BASE);
        if (isset($alert)) {

            switch (\base64_decode($alert)) {
                case 'success':
                    $router->redirect("/usuario/area/{$alert}");
                    break;
                case 'connecterror':
                    $router->redirect("/ooops/{$alert}");
                    break;
                case 'searcherror':
                    $router->redirect("/ooops/{$alert}");
                    break;
                case 'passerror':
                    $router->redirect("/usuario/area/atualizar/{$alert}");
                    break;
                case 'newpasserror':
                    $router->redirect("/usuario/area/atualizar/{$alert}");
                    break;
            }
        }
    }

    //Rota para gestão de serviços (contratação e cancelamentos).
    public function userServices($data)
    {
        $list = new ServicoContratadoDao();
        $userServices = $list->list($this->user->Id);
        
        $title = 'SERVIÇOS | ';
        require __DIR__ . "/../../views/user/management.php";

        //ATIVA SERVIÇO
        if (isset($_POST['ativar'])) {
            $activate = new ServicoContratadoDao();
            $alert = $activate->activate($this->user->Id, $data);
        }
    }
}
