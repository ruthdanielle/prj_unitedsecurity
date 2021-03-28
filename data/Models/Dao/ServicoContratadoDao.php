<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\Connect;
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
    public function list($id)
    {

        $user = $this->find("idUsuario = :uid", "uid={$id}")->fetch(true);
        return $user;
    }

    //ATIVA SERVIÇOS
    public function activate($id, $data)
    {
        $conn = Connect::getInstance();
        $error = Connect::getError();

        $service = $data['servico'];

        if ($error) {
            return $alert = base64_encode('connecterror');
        } else {
            $sql = "INSERT INTO `servico_contratado`(`idUsuario`, `idServico`) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->bindValue(2, $service);
            try {
                $stmt->execute();
                return $alert = base64_encode('activeSuccess');
            } catch (\PDOException $e) {
                return $alert = base64_encode('activeError');

            }
        }
    }
}
