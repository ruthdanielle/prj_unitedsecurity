<?php

namespace Source\controllers;

use CoffeeCode\Router\Router;
use Data\Models\Contact;
use Data\Models\Dao\ContactDao;

session_start();
class ContactController
{
    // Rota pagina Contato 
    public function contact($data)
    {
        $title = 'CONTATO | ';
        require __DIR__ . "/../../views/contact.php";
    }

    //Rota POST para contatos variavel $data contem um array com os dados do formulario
    public function contactPost($data)
    {
        $title = 'CONTATO | ';

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
