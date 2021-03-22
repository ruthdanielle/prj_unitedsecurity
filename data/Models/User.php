<?php

namespace Data\Models;

// Classe para tratatamento de usuarios
class User
{
    private   $nome;
    private   $cpf;
    private   $telefone;
    private   $email;
    private   $senha;

    public function __construct(array $data)
    {
        function clear($input){
            $item =  htmlspecialchars($input); 
            return $item;
        }

        $this->nome = clear(filter_var($data['name'], FILTER_SANITIZE_STRING));
        $this->cpf = clear(filter_var($data['cpf'], FILTER_SANITIZE_NUMBER_INT));
        $this->telefone = clear(filter_var($data['tel'], FILTER_SANITIZE_NUMBER_INT)) ;
        $this->email = clear(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) ;
        $this->senha = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf(int $cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone(int $telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
