<?php

namespace Source\admin;

use CoffeeCode\Router\Router;
use Data\Models\Dao\ContactDao;
use Data\Models\Dao\UserDao;

session_start();

/**
 * Classe do tipo Controller.
 * AdminAreaController gerencia as requisições da rota de administradores. 
 */
class AdminAreaController
{
    private $admin;
    private $router;

    /**
     * Construtor verifica se o usuario autenticado é um usuario comun ou um administrador.
     */
    public function __construct()
    {
        $this->router = new Router(URL_BASE);
        $this->admin = $_SESSION['usuario'];
        if ((empty($this->admin->autenticado) && $this->admin->autenticado != true) || ($this->admin->tipo == false)) {

            $alert = base64_encode("accessonegado");
            $this->router->redirect("/ooops/{$alert}");
        }
    }


    /**
     * Rota para area central do admin.
     * Rota do tipo GET, responsavel por renderizar a area de usuario.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function adminArea($data)
    {
        $contact = new ContactDao();
        $result = $contact->list();
        $title = 'Gerenciar | ';
        require __DIR__ . "/../../views/admin/management.php";
    }

    /**
     * Rota para area central do admin.
     * Rota do tipo POST, responsavel por definir um contato como resolvido.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function adminAreaPost($data)
    {
        $contact = new ContactDao();
        $alert = $contact->done($data);
        $this->router->redirect("/admin/area/$alert");
    }



    
    /**
     * Rota para promover conta.
     * Rota do tipo GET, responsavel por renderizar a area de promoção de usuario.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function adminPromoter($data)
    {
        $title = 'Promover | ';

        //Validações para buscar na tabela de usuarios
        if (isset($_GET['buscar'])) {
            $findfor = isset($_GET['buscarpor']) ? $_GET['buscarpor'] : null;
            if ($findfor == 'cpf') {
                $find = (int) $_GET['busca'];
                $find = htmlspecialchars(filter_var($find, FILTER_SANITIZE_NUMBER_INT));

                if (!filter_var($find, FILTER_VALIDATE_INT)) {
                    $alert = base64_encode("NaN");
                    $this->router->redirect("/admin/area/promover/{$alert}");
                }
            } else {

                $find = htmlspecialchars(filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_EMAIL));
                if (!$find || \is_numeric($find)) {
                    $alert = base64_encode("invalidemail");
                    $this->router->redirect("/admin/area/promover/{$alert}");
                }
            }

            $search = new UserDao();
            $user = $search->search($findfor, $find);
            if ($user === []) {
                $alert = base64_encode('noresult');
                $this->router->redirect("/admin/area/promover/{$alert}");
            }
        }



        require __DIR__ . "/../../views/admin/promoter.php";
    }

    /**
     * Rota para promover conta.
     * Rota do tipo POST, responsavel por atualizar tipo de conta de usuario.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function adminPromoterPost($data)
    {
        $alert = base64_encode('selecione');
        if (isset($data['select']) && ($data['select'] !== [])) {
            $upgrade = new UserDao();
            $alert = $upgrade->upgrade($data);
            if ($alert) {

                $this->router->redirect("/admin/area/promover/{$alert}");
            }
        } else {
            $this->router->redirect("/admin/area/promover/{$alert}");
        }
    }
}
