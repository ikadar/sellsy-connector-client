<?php

namespace IKadar\SellsyConnectorClient;

use IKadar\Repository\QueryBuilder\APIQueryBuilder;
use IKadar\Repository\QueryBuilder\APIQueryBuilderInterface;
use IKadar\HTTPClient\Request\RequestFactory;

class SellsyConnectorAPIQueryBuilder extends APIQueryBuilder implements APIQueryBuilderInterface
{
    public function __construct(
        private readonly RequestFactory $requestFactory,
    )
    {
        parent::__construct($requestFactory);
        $this->requestFactory->loadRoutes(__DIR__ . '/' . "sellsy_routes.yaml");
    }
}
