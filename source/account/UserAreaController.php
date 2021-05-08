<?php

namespace Source\account;

use CoffeeCode\Router\Router;
use Data\Models\Dao\ServicoContratadoDao;
use Data\Models\Dao\UserDao;

session_start();

/**
 * Classe do tipo Controller.
 * UserAreaController gerencia as requisições da rota de area de usuarios. 
 */
class UserAreaController
{

    private $user;
    private $router;

    /**
     * Construtor verifica se o usuario autenticado é um usuario comun ou um administrador.
     */
    public function __construct()
    {
        $this->router = new Router(URL_BASE);
        $this->user = $_SESSION['usuario'];
        if ((empty($this->user->autenticado) && $this->user->autenticado != true)) {

            $alert = base64_encode("accessonegado");
            $this->router->redirect("/ooops/{$alert}");
        }
    }

    /**
     * Rota para area do usuario.
     * Rota do tipo GET, responsavel por renderizar area do usuario.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function userArea($data)
    {
        //verifica quem esta tratando dados Usuario comun ou administrador e seta o titulo para cada situação.
        if (isset($this->user) && ($this->user->tipo == true)) {
            $title = 'Gerenciar | ';
        } else {
            $title = 'Minha Área | ';
        }


        require __DIR__ . "/../../views/user/account.php";
    }

    /**
     * Rota para atualizar dados do usuario.
     * Rota  responsavel por atualizar dados cadastrais.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function userUpdate($data)
    {

        $title = 'Atualizar | ';
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
                    if ($this->user->tipo) {
                        $this->router->redirect("/admin/area/{$alert}");
                    } else {
                        $this->router->redirect("/usuario/area/{$alert}");
                    }
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

    /**
     * Rota para gerenciar seriviços.
     * Rota do tipo GET, responsavel por renderizar o conteudo da pagina.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function userServices($data)
    {
        if (!$this->user->tipo) {
            $list = new ServicoContratadoDao();
        $userServices = $list->list($this->user->Id);

        $title = 'Serviços | ';
        require __DIR__ . "/../../views/user/management.php";
        
        }else {
            $this->router->redirect("/admin/area");
        }
        
    }
    
    /**
     * Rota para atualizar contratação e cancelamento de serviços.
     * Rota do tipo POST, responsavel por processar o formulario e redirecionar a resposta.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
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
