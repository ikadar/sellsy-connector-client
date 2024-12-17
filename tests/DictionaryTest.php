<?php

namespace Tests;

use IKadar\HTTPClient\Client\Client;
use IKadar\HTTPClient\Connection\StaticOAuthConnection;
use IKadar\HTTPClient\Request\RequestFactory;
use IKadar\Repository\DataAccess\HTTPAPIClient;
use IKadar\SellsyConnectorClient\Repository\DictionaryRepository;
use IKadar\SellsyConnectorClient\SellsyConnectorAPIQueryBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class DictionaryTest extends TestCase
{

    private Client $client;
    private DictionaryRepository $dictionaryRepository;

    protected function setUp(): void
    {
        parent::setUp();

        // This value will come from tenant configuration
        // It probably won't change by tenant,
        // but better to store it there until the configuration implementation improvements.
        $testApiRootUrl = "https://sellsy-connector.wheel.digital/api";
        $testApiVersion = "v1";
        $testApiClientId = "65bd1d2a73e19";
        $testApiSecret = "EO8Dt2KTjuRGmOnHEWuJbg==";

        // todo: $this->client can come from services.yaml as a parameter
        $this->dictionaryRepository = new DictionaryRepository(
            new HTTPAPIClient(new Client(
                new StaticOAuthConnection(
                    $testApiRootUrl,
                    $testApiVersion,
                    $testApiClientId,
                    $testApiSecret,
                )
            )),
            new SellsyConnectorAPIQueryBuilder(new RequestFactory())
        );
    }

    public function testGetRateCategories()
    {

        dump(__METHOD__);

        try {
            $response = $this->dictionaryRepository->getRateCategories();
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetRateCategoryByLabel()
    {

        dump(__METHOD__);

        $label = "HT";
        try {
            $response = $this->dictionaryRepository->getRateCategoryByLabel($label);
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetTaxes()
    {

        dump(__METHOD__);

        try {
            $response = $this->dictionaryRepository->getTaxes();
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetTaxByRate()
    {

        dump(__METHOD__);

        $label = "20";
        try {
            $response = $this->dictionaryRepository->getTaxByLabel($label);
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetShippingCompanies()
    {

        dump(__METHOD__);

        try {
            $response = $this->dictionaryRepository->getShippingCompanies();
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetShippingCompanyByReference()
    {
        dump(__METHOD__);

        $reference = "DPD";
        try {
            $response = $this->dictionaryRepository->getShippingCompanyByReference($reference);
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

        dump($response);

        $this->assertTrue(true); // Example assertion
    }

}
