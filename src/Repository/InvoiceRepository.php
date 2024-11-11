<?php

namespace IKadar\SellsyConnectorClient\Repository;

use Exception;
use IKadar\Repository\Repository\Repository;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class InvoiceRepository extends Repository
{

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function createInvoice($payload): ?array
    {
        return $this->executeQuery("createInvoice", $payload)->get();
    }

}
