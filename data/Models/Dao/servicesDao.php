<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\DataLayer;

class servicesDao extends DataLayer
{
    //Abstração da tabela Cadastro para uso do Datalayer
    public function __construct()
    {
        parent::__construct(
            "servicos",
            [
                "nome",
                "descricao",
                "imagem"
            ],
            "id",
            false
        );
    }

    //Lista todos os serviços registrado e retorna para ServicesController:services
    public function listar()
    {

        $services = $this->find()->fetch(true);
 
        $cont = 0;
        foreach ($services as $service) {
            $servico[$cont] = $service->data();
            $cont++;
        }

        return $servico;
    }
}
