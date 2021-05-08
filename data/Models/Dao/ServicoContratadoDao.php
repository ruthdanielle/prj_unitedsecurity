<?php

namespace Data\Models\Dao;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;
/**
 * Classe ServicoContratadoDao
 * Responsavel por persistir os dados de serviços contratados em banco de dados.
 */
class ServicoContratadoDao extends DataLayer
{
    /**
     * Abstração da tabela Cadastro para uso do Datalayer utilizado para persistir os dados.
     */
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

    /**
     * Recupera os dados do usuario com base em seu id.
     * @param int $id
     * @return array Collection
     */
    public function list($id)
    {

        $user = $this->find("idUsuario = :uid", "uid={$id}")->fetch(true);
        return $user;
    }

    /**
     * ATIVA SERVIÇOS.
     * Ativa o serviço selecionado por um usuario
     * @param int $id
     * @param array $data contento iformaçao do serviço selecionado no indice $data['servico']
     * @return string
     */
    public function activate($id, $data)
    {
        $conn = Connect::getInstance();
        $error = Connect::getError();

        $service = isset($data['servico'])? $data['servico'] : null ;

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

    /**
     * CANCELA SERVIÇOS.
     * Cancela o serviço selecionado por um usuario
     * @param int $id
     * @param array $data contento iformaçao do serviço selecionado no indice $data['servico']
     * @return string
     */
    public function cancel($id, $data)
    {
        $conn = Connect::getInstance();
        $error = Connect::getError();

        $service = isset($data['servico'])? $data['servico'] : null ;

        if ($error) {
            return $alert = base64_encode('connecterror');
        } else {

            $find = $this->find("idUsuario = :uid AND idServico = :sid", "uid={$id}&sid={$service}")->fetch(true);

            if (isset($find)) {
                $sql = "DELETE FROM`servico_contratado` WHERE idUsuario = ? AND idServico = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(1, $id);
                $stmt->bindValue(2, $service);
                try {
                    $stmt->execute();
                    return $alert = base64_encode('cancelSuccess');
                } catch (\PDOException $e) {
                    return $alert = base64_encode('cancelError');
                }
            }else {
                return $alert = base64_encode('ServiceNotFound');
            }
        }
    }
}
