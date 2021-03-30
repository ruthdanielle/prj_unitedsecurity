<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;
use Data\Models\Contact;

class ContactDao extends DataLayer
{
    public function __construct()
    {
        //Abstração da tabela Cadastro para uso do Datalayer
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

    // inserção do contato no banco de dados
    public function register(Contact $data)
    {

        // Chamada de conexão com o banco e erros
        $conn = Connect::getInstance();
        $error = Connect::getError();

        // Verifica se existe erro de conexão e retorna
        // Registra os dados em banco e retorna mensagem para UserController:login
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

    public function list()
    {
        $contacts = $this->find()->order("dtContato ASC")->order("situacao ASC")->fetch(true);
        
        foreach ($contacts as $item) {
            $contact[] = $item->data();
        }
        return $contact;
    }

    public function done($id){
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
