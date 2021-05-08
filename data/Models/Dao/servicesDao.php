<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Classe ServicesDao
 * Responsavel por persistir os dados de serviços em banco de dados.
 */
class servicesDao extends DataLayer
{
    /**
     * Abstração da tabela Cadastro para uso do Datalayer utilizado para persistir os dados.
     */
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

    /**
     * Lista todos os serviços registrados.
     * @return array | Collection 
     */ 
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
