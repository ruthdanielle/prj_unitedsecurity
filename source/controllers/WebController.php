<?php

namespace Source\controllers;

session_start();

class webController
{
    //home
    public function home($data){
        $title = 'HOME | ';
        require __DIR__ . "/../../views/home.php";
    }

    //Rota referente a pagina sobre nós.
    public function aboutUs(){
        $title = 'SOBRE | ';
        require __DIR__ . "/../../views/about.php";
    }

}
