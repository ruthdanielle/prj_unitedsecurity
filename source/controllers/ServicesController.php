<?php

namespace Source\controllers;

use Data\Models\Dao\servicesDao;

session_start();
/**
 * Classe do tipo Controller.
 * ServicesController gerencia as requisições da rota de serviços. 
 */
class ServicesController
{
    /**
     * Rota referente a serviços.
     * Os dados que chegam por requisições ficam retidos em um array $data
     * @param array $data
     * 
     */
    public function services($data){
        $title = 'Serviços | ';
        
        $services = new servicesDao();
        $service = $services->listar();
        
        require __DIR__ . "/../../views/services.php";
        
    }
}
