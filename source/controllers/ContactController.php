<?php

namespace Source\controllers;

use CoffeeCode\Router\Router;
use Data\Models\Contact;
use Data\Models\Dao\ContactDao;

session_start();

/**
 * Classe do tipo Controller.
 * ContactController gerencia as requisições da rota de contatos. 
 */
class ContactController
{
    /**
     * Rota pagina Contato.
     * Rota do tipo GET, responsavel por renderizar a pagina de contatos.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function contact($data)
    {
        $title = 'Contato | ';
        require __DIR__ . "/../../views/contact.php";
    }

    /**
     * Rota para contatos.
     * Rota do tipo POST, responsavel por inserir um novo contato no banco de dados.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */

    public function contactPost($data)
    {
        $title = 'Contato | ';

        // Verifica se o botão foi pressionado e instancia a classe de contato e registra o contato
        if ($_POST['contato']) {
            $contact = new Contact($data);
            $contactInsert = new ContactDao();
            $alert = $contactInsert->register($contact);
        }

        $router = new Router(URL_BASE);


        if (base64_decode($alert) != 'sucesso') {
            $router->redirect("/ooops/$alert");
        } else {
            $router->redirect("/contato/$alert");
        }
    }
}
