<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;
use Data\Models\Contact;

/**
 * Classe ContactDao
 * responsavel por persistir contatos em banco de dados.
 * @author Alan Nonato 
 */
class ContactDao extends DataLayer
{
    /**
     * Abstração da tabela Cadastro para uso do Datalayer utilizado para persistir os dados.
     */
    public function __construct()
    {
        parent::__construct(
            "contato",
            [
                "nome",
                "telefone",
                "email",
                "mensagem"
            ],
            "Id",
            false
        );
    }

    /**
     * Inserção do contato no banco de dados.
     * Metodo recebe um objeto da classe Contact como parametro
     * e devolve uma string em resposta.
     * @param  object $data
     * @return string $alert
     */
    public function register(Contact $data)
    {

        /**
         * $conn
         * Chamada de conexão com o banco e erros
         * @var PDO
         */ 
        $conn = Connect::getInstance();
        $error = Connect::getError();

        // Verifica se existe erro de conexão e retorna
        // Registra os dados em banco e retorna mensagem
        if ($error) {
            $alert = base64_encode('connecterror');
            return $alert;
        } else {

            $sql = "INSERT INTO `contato`(`nome`, `telefone`, `email`, `assunto`, `mensagem`) VALUES (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $data->getNome());
            $stmt->bindValue(2, $data->getTelefone());
            $stmt->bindValue(3, $data->getEmail());
            $stmt->bindValue(4, $data->getAssunto());
            $stmt->bindValue(5, $data->getMensagem());
            $stmt->execute();

            $alert = base64_encode('sucesso');
            return $alert;
        }
    }

    /**
     * Lista os contatos existentes.
     * @return array
     */
    public function list()
    {
        $contacts = $this->find()->order("dtContato ASC")->order("situacao ASC")->fetch(true);
        if (isset($contacts)) {
          foreach ($contacts as $item) {
            $contact[] = $item->data();
        }
        return $contact;
        }
        return [];
    }

    /**
     * Metodo marca o contato como resolvidos
     * @param array $id['idContato']
     */
    public function done($id){
        /**
         * $id
         * Recupera o id passado via parametro.
         * @var int
         */
        $id = $id['idContato'];
        $done = $this->find("Id = :cid", "cid={$id}")->fetch(true);
        $done[0]->situacao = true;
       foreach ($done as $item) {
           $contact = $item->data();
       }
       $done[0]->save();
        return $alert = base64_encode('solve');;
        
    }
}
