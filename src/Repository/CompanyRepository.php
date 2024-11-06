<?php

namespace IKadar\SellsyConnectorClient\Repository;

use Exception;
use IKadar\Repository\Repository\Repository;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CompanyRepository extends Repository
{

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getCompanies($name = null, $page = 0, $limit = 10): ?array
    {
        return $this->executeQuery("getCompanies", [
            "name" => $name,
            "page" => $page,
            "limit" => $limit
        ]);
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getCompanyById($sid, $id): ?array
    {
        $response = $this->executeQuery("getCompanyById", [
            "sid" => $sid,
            "id" => $id
        ]);
        return $response["data"][0];
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getCompaniesByIds($sid, $ids): ?array
    {
        return $this->executeQuery("getCompaniesByIds", [
            "sid" => $sid,
            "sellsy_ids" => $ids
        ]);
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getNonexistentEndpoint($sid): ?array
    {
        return $this->executeQuery("getNonexistentEndpoint", [
            "sid" => $sid
        ]);
    }

}
