<?php

namespace IKadar\SellsyConnectorClient\Repository;

use Exception;
use IKadar\Repository\Repository\Repository;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class DictionaryRepository extends Repository
{

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getRateCategories($sid, $label = null, $page = 0, $limit = 10): ?array
    {
        return $this->executeQuery("getRateCategories", [
            "sid" => $sid,
            "label" => $label,
            "page" => $page,
            "limit" => $limit
        ]);
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getRateCategoryByLabel($sid, $label = null, $page = 0, $limit = 10): ?array
    {
        return $this->executeQuery("getRateCategories", [
            "sid" => $sid,
            "label" => $label,
            "page" => $page,
            "limit" => $limit
        ])["data"][0];
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getTaxes($sid, $rate = null, $page = 0, $limit = 10): ?array
    {
        $response = $this->executeQuery("getTaxes", [
            "sid" => $sid,
            "rate" => $rate,
            "page" => $page,
            "limit" => $limit
        ]);
        return $response;
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getTaxByLabel($sid, $rate = null, $page = 0, $limit = 10): ?array
    {
        $response = $this->executeQuery("getTaxes", [
            "sid" => $sid,
            "rate" => $rate,
            "page" => $page,
            "limit" => $limit
        ]);
        return $response["data"][0];
    }

}
