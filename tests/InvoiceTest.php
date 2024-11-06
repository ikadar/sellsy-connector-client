<?php

namespace Tests;

use IKadar\HTTPClient\Client\Client;
use IKadar\HTTPClient\Connection\StaticOAuthConnection;
use IKadar\HTTPClient\Request\RequestFactory;
use IKadar\Repository\DataAccess\HTTPAPIClient;
use IKadar\SellsyConnectorClient\Repository\InvoiceRepository;
use IKadar\SellsyConnectorClient\SellsyConnectorAPIQueryBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class InvoiceTest extends TestCase
{

    private Client $client;
    private InvoiceRepository $invoiceRepository;

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
        $this->invoiceRepository = new InvoiceRepository(
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

    public function testCreateInvoice()
    {

        $payload = [
            "sid" => "s1",
            "date" => "2024-07-25",
            "due_date" => "2024-08-01",
            "sellsy_company_id" => 35072332,
            "rate_category_id" => 165512,
            "subject" => "Commande #106 - Demeco",
            "public_link_enabled" => true,
            "order_reference" => "commande manuelle de la part d'IRINA (BDC excel)",
            "shipping_date" => "2024-07-25",
            "delay" => 0,
            "single_rows" => [
                [
                    "purchase_amount" => "0.00",
                    "unit_amount" => "105.0",
                    "tax_id" => 4147489,
                    "quantity" => "1.00",
                    "reference" => "",
                    "description" => "Cartes de visite demeco \"agence\" (Aux Déménageurs De Normandie David Amounie ...)<br/>1000 unité"
                ],
                [
                    "purchase_amount" => "0.00",
                    "unit_amount" => "69.60",
                    "tax_id" => 4147489,
                    "quantity" => "1.00",
                    "reference" => "",
                    "description" => "Livrets Individuels de Contrôle (LIC)<br/>30 unité"
                ]
            ],
            "shipping_rows" => [
                [
                    "unit_amount" => "0",
                    "tax_id" => 4147489,
                    "quantity" => "1.00"
                ]
            ]
        ];

        dump(__METHOD__);

        try {
            $response = $this->invoiceRepository->createInvoice($payload);
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
