<?php

namespace Source\controllers;

session_start();

/**
 * Classe do tipo Controller.
 * ErrorController gerencia as requisições da rota de erros. 
 */
class ErrorController
{

    /**
     * Rota de fallback.
     * Rota do tipo GET, em caso de erro a variavel $data armazena o evento e redireciona para pagina de erros.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function error($data){
        $title = 'Erro | ';
        require __DIR__ . "/../../views/error/error.php";
        
    }
    
}
