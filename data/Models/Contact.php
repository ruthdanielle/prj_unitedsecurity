<?php

namespace Data\Models;

// Classe para tratatamento de contatos
class Contact
{
    private $nome;
    private $assunto;
    private $telefone;
    private $email;
    private $mensagem;

    public function __construct(array $data)
    {
        
        function clear($input)
        {
            $item =  htmlspecialchars($input);
            return $item;
        }

        $this->nome = clear(filter_var($data['name'], FILTER_SANITIZE_STRING));
        $this->telefone = clear(filter_var($data['tel'], FILTER_SANITIZE_NUMBER_INT));
        $this->email = clear(filter_var($data['emailcon'], FILTER_SANITIZE_EMAIL)) ;
        $this->assunto = clear(filter_var($data['subject'], FILTER_SANITIZE_STRING));
        $this->mensagem = filter_var($data['mensagem'], FILTER_SANITIZE_STRING);
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

    public function getAssunto()
    {
        return $this->assunto;
    }
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;

        return $this;
    }

    public function getMensagem()
    {
        return $this->mensagem;
    }
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;

        return $this;
    }
}
