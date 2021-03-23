<?php

namespace Source\controllers;

use Data\Models\Dao\servicesDao;

session_start();
class ServicesController
{
    // Rota referente a serviços
    public function services($data){
        $title = 'SERVIÇOS | ';
        
        $services = new servicesDao();
        $service = $services->listar();
        
        require __DIR__ . "/../../views/services.php";
        
    }
}
