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
    public function getRateCategories($label = null, $page = 0, $limit = 10): ?array
    {
        return $this->executeQuery("getRateCategories", [
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
    public function getRateCategoryByLabel($label = null, $page = 0, $limit = 10): ?array
    {
        return $this->executeQuery("getRateCategories", [
            "label" => $label,
            "page" => $page,
            "limit" => $limit
        ])["data"][0];
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getTaxes($rate = null, $page = 0, $limit = 10): ?array
    {
        $response = $this->executeQuery("getTaxes", [
            "rate" => $rate,
            "page" => $page,
            "limit" => $limit
        ]);
        return $response;
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getTaxByLabel($rate = null, $page = 0, $limit = 10): ?array
    {
        $response = $this->executeQuery("getTaxes", [
            "rate" => $rate,
            "page" => $page,
            "limit" => $limit
        ]);
        return $response["data"][0];
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getShippingCompanies(): ?array
    {
        $response = $this->executeQuery("getShippingCompanies", []);
        return $response["data"];
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function getShippingCompanyByReference($reference = null): ?array
    {
        $response = $this->executeQuery("getShippingCompanies", [
            "reference" => $reference
        ]);
        return $response["data"][0];
    }

}
