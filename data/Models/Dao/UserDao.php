<?php


namespace Data\Models\Dao;


use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;
use Data\Models\User;


class UserDao extends DataLayer
{
    //Abstração da tabela Cadastro para uso do Datalayer
    public function __construct()
    {
        parent::__construct(
            "cadastro",
            [
                "nome",
                "cpf",
                "telefone",
                "email",
                "senha",
                "dtCadastro",
                "dtAtt",
                "tipo"
            ],
            "Id",
            true
        );
    }

    // inserção de usuarios na tabela Cadastro
    public function register(User $user)
    {
        // Chamada de conexão com o banco e erros
        $conn = Connect::getInstance();
        $error = Connect::getError();

        // Verificação de erro de conexão, cpf e email existente no banco
        // Inserção e retorna mensagem para o controlador UserController:register
        if ($error) {
            $alert = base64_encode('connecterror');
        } elseif (!(is_numeric($user->getCpf())) || !(is_numeric($user->getTelefone()))) {
            return $alert = base64_encode('interror');
        } else {
            $valida = $this->valida($user->getEmail(), $user->getCpf());
            if ($valida['email'] && $valida['cpf']) {

                $sql = "INSERT INTO `cadastro`(`nome`, `cpf`, `telefone`, `email`, `senha`) VALUES (?,?,?,?,?);";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $user->getNome());
                $stmt->bindValue(2, $user->getCpf());
                $stmt->bindValue(3, $user->getTelefone());
                $stmt->bindValue(4, $user->getEmail());
                $stmt->bindValue(5, $user->getSenha());
                $stmt->execute();

                return $alert = base64_encode('sucesso');
            } elseif ($valida['email'] == false) {
                return $alert = base64_encode('emailerror');
            } elseif ($valida['cpf'] == false) {
                return $alert = base64_encode('cpferror');
            }
        }
    }

    //verificação de CPF e Email existente no banco
    public function valida($valEmail, $valCpf): array
    {
        //lista todos os valores encontrados no banco
        $list = $this->find()->fetch(true);
        foreach ($list as $value) {
            $cpf[] =  $value->cpf;
            $email[] = $value->email;
        }

        // Verifica de fato se existe o cpf e email no banco e retorna
        if (!(in_array($valEmail, $email))) {
            $valida['email'] = true;
        } else {
            $valida['email'] = false;
        }
        if (!(in_array($valCpf, $cpf))) {
            $valida['cpf'] = true;
        } else {
            $valida['cpf'] = false;
        }

        return $valida;
    }

    public function clear($input)
    {
        $item =  htmlspecialchars($input);
        return $item;
    }

    // Checa se os dados para login confirmam e cria uma Sessão 
    public function login($data)
    {
        //verifica se o email e senha que vieram do front estão setados e os armazena
        if (isset($data['email']) && isset($data['password'])) {
            $userEmail = $data['email'];
            $userPass = $data['password'];
        }

        // Busca no banco um usuario com o email correspondente ao enviado pelo front e o armazena
        $achar =  $this->find("email = :email", "email={$userEmail}")->fetch(true);
        if (isset($achar)) {
            foreach ($achar as $value) {
                $user = $value->data();
            }
        }

        // Verifica se senha criptografada e email do banco corresponde com a informada,
        // cria uma sessão com o objeto autenticado e retorna a situação
        if ((password_verify($userPass, $user->senha)) && $user->email == $userEmail) {

            $user->autenticado = true;
            $_SESSION['usuario'] = $user;

            if ($user->tipo) {
                return $alert = base64_encode('adminSuccess');
                unset($user);
            } else {
                return $alert = base64_encode('userSuccess');
                unset($user);
            }
        } else {
            return $alert = base64_encode('loginerror');
        }
    }

    //UPDATE DE USUARIOS
    public function att($id, $data)
    {
        //tratamento variaveis do front-end
        $newTel = filter_var($data['telAtt'], FILTER_SANITIZE_NUMBER_INT);
        $pass = $data['passwordAtt'];
        $newPass = $data['passwordAtt1'];
        $checkPass = $data['passwordAtt2'];

        $conn = Connect::getInstance();
        $error = Connect::getError();

        //verifica se existe algum erro de conexão e atualiza os dados
        if ($error) {
            $alert = base64_encode('connecterror');
        } else {

            $user = (new UserDao())->findById($id, 'telefone, senha, dtAtt');

            if ($user->fail()) {
                return $alert = base64_encode('searcherror');
            }
            if (password_verify($pass, $user->senha)) {

                if ($newPass == $checkPass) {
                    $user->senha = password_hash($newPass, PASSWORD_DEFAULT);

                    if (isset($newTel)) {
                        $user->telefone =  $newTel;
                    }

                    $sql = "UPDATE `cadastro` SET `telefone`= ?,`senha`= ? WHERE Id = ? ;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(1, $user->telefone);
                    $stmt->bindValue(2, $user->senha);
                    $stmt->bindValue(3, $id);
                    $stmt->execute();

                    $_SESSION['usuario']->telefone = $user->telefone;
                    $_SESSION['usuario']->senha = $user->senha;
                    unset($_SESSION['usuario']->dtAtt);
                    $_SESSION['usuario']->dtAtt = $user->dtAtt;

                    return $alert = base64_encode('success');
                } else {
                    return $alert = base64_encode('newpasserror');
                }
            } else {
                echo"<pre>";
                print_r($_SESSION['usuario']);
                echo "<hr>";
                print_r($user);
                echo"</pre>";
                return $alert = base64_encode('passerror');
            }
        }
    }
}
