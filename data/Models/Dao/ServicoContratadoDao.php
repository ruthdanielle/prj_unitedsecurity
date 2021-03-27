<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\DataLayer;

class ServicoContratadoDao extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "servico_contratado",
            [
                "idUsuario",
                "idServico",
                "dtContrato"
            ],
            "idUsuario",
            true
        );
    }

    //LISTA OS SERVIÇOS DO USUARIO
    public function list($id){

        $user = $this->find("idUsuario = :uid", "uid={$id}")->fetch(true);
        return $user;

    }
}
