<?php

namespace Source\admin;

use CoffeeCode\Router\Router;

session_start();
class AdminAreaController
{
    private $admin;
    private $router;

    //Construtor verifica se o usuario autenticado é um usuario comun ou um administrador.
    public function __construct()
    {
        $this->router = new Router(URL_BASE);
        $this->admin = $_SESSION['usuario'];
        if ((empty($this->admin->autenticado) && $this->admin->autenticado != true) || ($this->admin->tipo == false)) {
            
            $alert = base64_encode("accessonegado");
            $this->router->redirect("/ooops/{$alert}");
        }   
    } 

    // Roda para area central do admin
    public function adminArea($data){
        $title = 'GERENCIAR | ';
        require __DIR__."/../../views/admin/management.php";
    }

    // Rota para promover conta
    public function adminPromoter(){
        $title = 'ALTERAR CONTA | ';
        require __DIR__."/../../views/admin/promoter.php";
    }
    public function adminPromoterPost(){

    }
  
}
