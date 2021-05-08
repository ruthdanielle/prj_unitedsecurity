<?php

namespace Source\controllers;

session_start();

/**
 * Classe do tipo Controller.
 * webController gerencia as requisições da rota principal. 
 */
class webController
{

     /**
     * Rota pagina Principal.
     * Rota do tipo GET, responsavel por renderizar a pagina principal.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function home($data){
        $title = 'Home | ';
        require __DIR__ . "/../../views/home.php";
    }

    /**
     * Rota para pagina sobre.
     * Rota do tipo GET, responsavel por renderizar a pagina sobre.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function aboutUs(){
        $title = 'Sobre | ';
        require __DIR__ . "/../../views/about.php";
    }

}
