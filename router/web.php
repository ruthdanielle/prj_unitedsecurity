<?php

require_once __DIR__.'../../vendor/autoload.php';

/**************
 * Controllers
 **************/
use CoffeeCode\Router\Router;

/**
 * instancia do router com a url padão
 */
$router = new Router(URL_BASE);

/*******************************
 * NAMESPACE SOURCE\CONTROLLER *
 *******************************/
$router->namespace("Source\controllers");


/*************
 * HOMECONTROLLER
 * home
 *************/
$router->group(null);
$router->get("/", "WebController:home");
$router->get("/home", "WebController:home");

/*********
 * ABOUT
 * about us
 *********/
$router->get("/sobre", "WebController:aboutUs");


/*************
 * SERVICESCONTROLLER
 * services
 *************/
$router->get("/servicos", "ServicesController:services");





/*************
 * ContactController
 * contact
 *************/
$router->group("contato");
$router->get("/{contactalert}", "ContactController:contact");
$router->get("/", "ContactController:contact");
$router->post("/", "ContactController:contactPost");


/************
 * ERROS
 ************/
$router->group("ooops");
$router->get("/{errcode}", "ErrorController:error");





/******************************
 * NAMESPACE SOURCE\ACCOUNT   *
 ******************************/
$router->namespace("Source\account");


/*****************
 * USUARIO
 * Source\account
 * UserController
 * register
 * login
 * userUpdate
 * userArea
 * userManagement
 *****************/
$router->group("usuario");
//ROTAS ALERTAS
$router->get("/entrar/{loginalert}", "UserController:login");
$router->get("/cadastrar/{registeralert}", "UserController:register");
$router->get("/area/{areaalert}", "UserAreaController:userArea");
$router->get("/area/atualizar/{updatealert}", "UserAreaController:userUpdate");
$router->get("/area/servicos/{servicesalert}", "UserAreaController:userServices");

//ROTAS CADASTRO
$router->get("/cadastrar", "UserController:register");
$router->post("/cadastrar", "UserController:register");

//ROTAS LOGIN
$router->get("/entrar", "UserController:login");
$router->post("/entrar", "UserController:login");
//LOGOUT
$router->get("/sair", "UserController:logOut");

//ROTAS AREA DO USUARIO
$router->get("/area", "UserAreaController:userArea");
$router->post("/area", "UserAreaController:userArea");

//ROTAS ATUALIZAR DADOS
$router->get("/area/atualizar", "UserAreaController:userUpdate");
$router->post("/area/atualizar", "UserAreaController:userUpdate");

//ROTAS SERVIÇOS
$router->get("/area/servicos", "UserAreaController:userServices");



/*****************
 * ADMIN
 * Source\account
 * AdminArea
 *****************/
$router->namespace("Source\admin");
$router->group("admin");
$router->get("/area/{areaalert}", "AdminAreaController:adminArea");
$router->get("/area", "AdminAreaController:adminArea");
$router->post("/area", "AdminAreaController:adminArea");


$router->dispatch();

if($router->error()){
   $router->redirect("/ooops/{$router->error()}");
}
