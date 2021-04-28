<?php

namespace Source\controllers;

session_start();
class ErrorController
{
    // Rota de fallback, em caso de erro a variavel $data armazena o evento e redireciona para pagina de erros
    public function error($data){
        $title = 'Erro | ';
        require __DIR__ . "/../../views/error/error.php";
        
    }
    
}
