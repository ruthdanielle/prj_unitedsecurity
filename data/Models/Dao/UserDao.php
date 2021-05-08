<?php


namespace Data\Models\Dao;


use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;
use Data\Models\User;

/**
 * Classe UserDao
 * Responsavel por persistir os dados de usuarios em banco de dados.
 */
class UserDao extends DataLayer
{
     /**
     * Abstração da tabela Cadastro para uso do Datalayer utilizado para persistir os dados.
     */
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


    /**
     * inserção de usuarios na tabela Cadastro.
     * @param object $user objeto da classe User
     * @return string
     */
    public function register(User $user)
    {
        // Chamada de conexão com o banco e erros
        $conn = Connect::getInstance();
        $error = Connect::getError();

        // Verificação de erro de conexão, cpf e email existente no banco
        // Inserção e retorna mensagem para o controlador UserController:register
        if ($error) {
            return $alert = base64_encode('connecterror');
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

    /**
     * valida.
     * verifica se o CPF e Email existente no banco de dados
     * @param string $valEmail
     * @param string $valCpf
     */

    public function valida($valEmail, $valCpf): array
    {
        /**
         * $list
         * lista todos os valores encontrados no banco de dados.
         * @var array
         */
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

    /**
     * clear.
     * Helper de sanitização.
     * @param string $input
     * @return string
     */
    public function clear($input)
    {
        $item =  htmlspecialchars($input);
        return $item;
    }

    // 
    /**
     * login.
     * Checa se os dados para login, autentica e cria uma Sessão
     * @param array $data contendo $data['email'] e $data['password']
     * @return string
     */   
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
    /**
     * att.
     * Atualiza dados de usuarios.
     * @param int $id
     * @param array $data contendo dados do formulario.
     * @return string
     */
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
                return $alert = base64_encode('passerror');
            }
        }
    }

    /**
     * Metodo search.
     * Busca usuarios cadastrados por CPF ou email
     * @param mixed $value
     * @param string $type
     * @return array
     */
    public function search($type, $value)
    {

        if ($type == 'cpf') {
            $user = $this->find("cpf LIKE '%{$value}%';", " ", "Id, nome, cpf, telefone, email, tipo")->fetch(true);
        } else {
            $user = $this->find("email LIKE '%{$value}%';", " ", "Id, nome, cpf, telefone, email, tipo")->fetch(true);
        }
        if (isset($user)) {

            foreach ($user as $item) {
                $data[] = $item->data();
            }
        }

        return isset($data) ? $data : [];
    }

    //
    /**
     * Metodo upgrade.
     * Atualiza tipo de conta do usuario
     * @param array $data 
     * $data['select'] possui id do usuario.
     * $data['promo'] possui o tipo selecionado à ser promovido
     * @return string
     */
    public function upgrade($data){
        $id = $data['select'];
        $type = $data['promo'];

        $user = $this->find("id = :uid", "uid={$id}")->fetch(true);
        $user[0]->tipo = $type;
        if ($user[0]->save()) {
            return base64_encode('upsuccess');
        }
            return base64_encode('upfail');
        
    }
}
