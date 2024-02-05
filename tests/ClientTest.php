<?php

namespace Tests;

use IKadar\HTTPClient\Client\Client;
use IKadar\HTTPClient\Connection\StaticOAuthConnection;
use IKadar\HTTPClient\Request\RequestFactory;
use IKadar\Repository\DataAccess\HTTPAPIClient;
use IKadar\SellsyConnectorClient\Repository\CompanyRepository;
use IKadar\SellsyConnectorClient\SellsyConnectorAPIQueryBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class ClientTest extends TestCase
{

    private Client $client;
    private CompanyRepository $companyRepository;

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
        $this->companyRepository = new CompanyRepository(
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

    public function testGetClients()
    {

        dump(__METHOD__);

        $name = "Orl";
        try {
            $response = $this->companyRepository->getCompanies($name);
        } catch (
        ClientExceptionInterface|
        RedirectionExceptionInterface|
        ServerExceptionInterface|
        TransportExceptionInterface
        $e
        ) {
        }

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetClientsByName()
    {

        dump(__METHOD__);

        $name = "Orl";
        $response = $this->companyRepository->getCompanies($name);

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetClientById()
    {

        dump(__METHOD__);

        $id = "37763649";
//        $id = "abc";
        $response = $this->companyRepository->getCompanyById($id);

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testGetClientsByIds()
    {

        dump(__METHOD__);

        $ids = [
            37763649,
            35115054
        ];

        $response = $this->companyRepository->getCompaniesByIds($ids);

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testNonexistentClient()
    {

        dump(__METHOD__);

        $ids = [
            0,
            1
        ];

        $response = $this->companyRepository->getCompaniesByIds($ids);

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }


    public function testNonexistentEndpoint()
    {

        dump(__METHOD__);

        try {
            $response = $this->companyRepository->getNonexistentEndpoint();
        } catch (\Exception $e) {
            dump($e);
        }

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    public function testNonexistentClientById()
    {

        dump(__METHOD__);

        $id = "1";
        try {
            $response = $this->companyRepository->getCompanyById($id);
        } catch (\Exception $e) {
            dump($e);
        }

//        dump($response);

        $this->assertTrue(true); // Example assertion
    }

    /*
    CompanyRepository(
        Connection(),
        QueryBuilder()
    )
     */

}
