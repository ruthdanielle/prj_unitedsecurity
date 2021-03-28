<?php

namespace Source\account;

use CoffeeCode\Router\Router;
use Data\Models\Dao\ServicoContratadoDao;
use Data\Models\Dao\UserDao;

session_start();

class UserAreaController
{

    private $user;
    private $router;

    //Construtor verifica se o usuario autenticado é um usuario comun ou um administrador.
    public function __construct()
    {
        $this->router = new Router(URL_BASE);
        $this->user = $_SESSION['usuario'];
        if ((empty($this->user->autenticado) && $this->user->autenticado != true)) {

            $alert = base64_encode("accessonegado");
            $this->router->redirect("/ooops/{$alert}");
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
        if (isset($alert)) {

            switch (\base64_decode($alert)) {
                case 'success':
                    $this->router->redirect("/usuario/area/{$alert}");
                    break;
                case 'connecterror':
                    $this->router->redirect("/ooops/{$alert}");
                    break;
                case 'searcherror':
                    $this->router->redirect("/ooops/{$alert}");
                    break;
                case 'passerror':
                    $this->router->redirect("/usuario/area/atualizar/{$alert}");
                    break;
                case 'newpasserror':
                    $this->router->redirect("/usuario/area/atualizar/{$alert}");
                    break;
            }
        }
    }

    //Rota para gestão de serviços (contratação e cancelamentos).
    //ROTA GET mostra o conteudo da pagina
    public function userServices($data)
    {

        $list = new ServicoContratadoDao();
        $userServices = $list->list($this->user->Id);

        $title = 'SERVIÇOS | ';
        require __DIR__ . "/../../views/user/management.php";
        
    }
    //ROTA POST PROCESSA E REDIRECIONA OS FORMULARIOS
    public function userServicesPost($data)
    {

         //ATIVA SERVIÇO
        if (isset($_POST['ativar'])) {
            $activate = new ServicoContratadoDao();
            $alert = $activate->activate($this->user->Id, $data);
        }

        //CANCELA SERVIÇO
        if (isset($_POST['cancela_servico'])) {
            $cancel = new ServicoContratadoDao();
            $alert = $cancel->cancel($this->user->Id, $data);
        }
        //REDIRECIONANDO MENSAGENS
        if (isset($alert)) {
            switch (\base64_decode($alert)) {
                case 'connecterror':
                    $this->router->redirect("/ooops/$alert");
                case 'activeSuccess':
                    $this->router->redirect("/usuario/area/servicos/$alert");
                    break;
                case 'activeError':
                    $this->router->redirect("/usuario/area/servicos/$alert");
                    break;
                case 'cancelSuccess':
                    $this->router->redirect("/usuario/area/servicos/$alert");
                    break;
                case 'ServiceNotFound':
                    $this->router->redirect("/usuario/area/servicos/$alert");
                    break;
                case 'cancelError':
                    $this->router->redirect("/usuario/area/servicos/$alert");
                    break;
            }
        }
    }
}
