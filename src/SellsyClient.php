<?php

namespace IKadar\SellsyConnectorClient;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SellsyClient
{
    private $client;

    public function __construct(
        private readonly string $APIRootUrl,
        array                   $defaultOptions = [],
        int                     $maxHostConnections = 6,
        int                     $maxPendingPushes = 50
    )
    {
        $this->client = HttpClient::create($defaultOptions, $maxHostConnections, $maxPendingPushes);
    }

    /**
     * @return \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    public function getClient(): \Symfony\Contracts\HttpClient\HttpClientInterface
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getAPIRootUrl(): string
    {
        return $this->APIRootUrl;
    }

    public function request($method, $apiEndPoint, $parameters, $options = [])
    {
        $parameters = $this->buildQueryString($parameters);

        if ($method === "GET") {
            // add parameters to root url as query string, in case of GET request
            $url = $this->getAPIRootUrl() . $apiEndPoint . $parameters;
        } elseif (in_array($method, ["POST", "PUT"])) {
            // add parameters to options as request body, in case of POST request
            $options["body"] = $parameters;
        } elseif ($method === "DELETE") {
            // todo: throw unimplemented verb exception
        } else {
            // todo: throw invalid verb exception
        }

        try {
            $response = $this->getClient()->request($method, $url, $options);
        } catch (TransportExceptionInterface $e) {
            // todo add exception handling
            return null;
        }

        // Get the status code
        $statusCode = $response->getStatusCode();
        dump($statusCode);

        // todo handle status codes

        // Get the content of the response
        $content = $response->getContent();
//        dump(json_decode($content, true));

        return json_decode($content, true);
    }

    private function buildQueryString($parameters = []): string
    {
        // http_build_query encodes query string that can cause issues with APIs that doesn't handle encoded values
        $queryString = http_build_query($parameters, "", null, PHP_QUERY_RFC1738);

        return $queryString === "" ? $queryString : sprintf("?%s", $queryString);
    }
}
