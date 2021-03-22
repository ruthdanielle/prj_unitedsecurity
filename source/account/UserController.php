<?php

namespace Source\account;

use CoffeeCode\Router\Router;
use Data\Models\Dao\UserDao;
use Data\Models\User;

session_start();

class UserController
{
    public $router;

    public function __construct()
    {
        $this->router = new Router(URL_BASE);
    }

    //Rota POST /entrar armazenando dados do formulario em $data 
    public function login($data)
    {

        //definindo titulo da pagina
        $title = 'ENTRAR | ';
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


    //Rota que destroi a sessão atual e redireciona para home
    public function logOut($data)
    {
        session_unset();
        session_destroy();
        $this->router->redirect("/home");
    }

    // Rota POST /usuario/cadastrar variavel $data contem itens formulario cadastro em array
    public function register($data)
    {
        // Definindo titulo da pagina
        $title = 'CADASTRAR | ';

        //verifica se a variavel esta setada e instancia um usuario com os dados contidos no array e o resgistra.
        if (isset($_POST['cadastrar'])) {
            $user = new User($data);
            $register = new UserDao();
            $alert = $register->register($user);
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
