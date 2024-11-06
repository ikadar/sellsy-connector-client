<?php

use IKadar\HTTPClient\Client\Client;
use IKadar\HTTPClient\Request\RequestFactory;
use IKadar\HTTPClient\Connection\StaticOAuthConnection;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    private $client;

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

        $this->client = new Client(
            new StaticOAuthConnection(
                $testApiRootUrl,
                $testApiVersion,
                $testApiClientId,
                $testApiSecret,
            ),
            new RequestFactory()
        );
    }

    public function testGetClients()
    {

        dump(__METHOD__);

        $requestFactory = new RequestFactory();
        $requestFactory->loadRoutes("./src/sellsy_routes.yaml");

        $request = $requestFactory->createRequest(
            "getCompanyById",
            parameters: [
                "id" => 1,
                "page" => "instance1",
                "foo" => 15,
                "bar" => "AAA",
                "sid" => "instance1"
            ],
            options: []
        );

        list($method, $url, $payload) = $request->fetch();

        dump($method);
        dump($url);
        dump($payload);

        $this->assertTrue(true); // Example assertion
    }

}
