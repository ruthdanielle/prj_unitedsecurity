<?php

namespace Data\Models;

/**
 * Classe Services.
 * Classe para transporte, tratatamento de dados de serviços 
 */
class Services
{
    private $nome;
    private $descricao;
    private $imagem;
    
    public function __construct(array $data)
    {
        function clear($input){
            $item =  htmlspecialchars($input); 
            return $item;
        }

        $this->nome = clear(filter_var($data['name'], FILTER_SANITIZE_STRING));
        $this->descricao = clear(filter_var($data['desc'], FILTER_SANITIZE_STRING));
        $this->imagem = clear(filter_var($data['img'], FILTER_SANITIZE_STRING)) ;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getImagem()
    {
        return $this->imagem;
    }
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }
}
