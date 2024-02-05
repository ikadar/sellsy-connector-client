<?php

namespace IKadar\SellsyConnectorClient\Repository;

use Exception;
use IKadar\HTTPClient\Client\ClientInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

trait RepositoryTrait
{
    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    protected function executeQuery($queryName, ...$args): ?array
    {
        $request = $this->queryBuilder->buildQuery($queryName, ...$args);
        return $this->getClient()->sendRequest($request);
    }
}
