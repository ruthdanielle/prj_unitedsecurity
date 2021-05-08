<?php

namespace Source\account;

use CoffeeCode\Router\Router;
use Data\Models\Dao\UserDao;
use Data\Models\User;

session_start();

/**
 * Classe do tipo Controller.
 * UserController gerencia as requisições da rota usuarios. 
 */
class UserController
{
    public $router;

    public function __construct()
    {
        $this->router = new Router(URL_BASE);
    }

    /**
     * Rota para login (/entrar).
     * Rota do tipo POST, responsavel por processar o formulario de entrada e redirecionar o usuario.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function login($data)
    {

        //definindo titulo da pagina
        $title = 'Entrar | ';
        //incluindo a pagina na tela
        require __DIR__ . "/../../views/user/login.php";

        //verifica se o botão foi clicado e instancia a classe
        if (isset($_POST['logar'])) {
            $user = new UserDao();
            $alert = $user->login($data);
        }

        //Verifica se a mensagem foi disparada e redireciona para cada situação
        if (isset($alert)) {

            switch (\base64_decode($alert)) {
                case 'adminSuccess':
                    $this->router->redirect("/admin/area/$alert");
                    break;

                case 'userSuccess':
                    $this->router->redirect("/usuario/area/$alert");
                    break;
                case 'loginerror':
                    $this->router->redirect("/usuario/entrar/$alert");
            }
        }
    }



    /**
     * Rota para sair.
     * Rota do tipo GET, responsavel por destroir a sessão atual e redireciona o usuario para home.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function logOut($data)
    {
        session_unset();
        session_destroy();
        $this->router->redirect("/home");
    }

    /**
     * Rota para Cadastrar usuario.
     * Rota do tipo POST, responsavel por cadastrar novos usuarios.
     * @param array $data.
     * Variavel padrão para recebimento de dados das requisições. 
     */
    public function register($data)
    {
        // Definindo titulo da pagina
        $title = 'Cadastro | ';

        //verifica se a variavel esta setada e instancia um usuario com os dados contidos no array e o resgistra.
        if (isset($_POST['cadastrar'])) {
            if ((is_numeric($data['cpf'])) && (is_numeric($data['tel']))) {

                $user = new User($data);
                $register = new UserDao();
                $alert = $register->register($user);
            } else {
                $alert = base64_encode('interror');
                $this->router->redirect("/usuario/cadastrar/$alert");  
            }
        }

        //verifica se teve um retorno do registro e o redireciona para cada situação.
        if (isset($alert)) {

            switch (\base64_decode($alert)) {
                case 'connecterror':
                    $this->router->redirect("/ooops/$alert");
                    break;

                case 'sucesso':
                    $this->router->redirect("/usuario/entrar/$alert");
                    break;

                default:
                    $this->router->redirect("/usuario/cadastrar/$alert");
            }
        }
        require __DIR__ . "/../../views/user/register.php";
    }
}
