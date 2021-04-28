<?php

namespace Source\controllers;

session_start();

class webController
{
    //home
    public function home($data){
        $title = 'Home | ';
        require __DIR__ . "/../../views/home.php";
    }

    //Rota referente a pagina sobre nós.
    public function aboutUs(){
        $title = 'Sobre | ';
        require __DIR__ . "/../../views/about.php";
    }

}
