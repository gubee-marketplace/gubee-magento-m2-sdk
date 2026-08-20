<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Sales\Order\LogisticTypeMappingApi;
use Gubee\SDK\Resource\AbstractResource;

class LogisticTypeMappingResource extends AbstractResource
{
    public function getLogisticTypeMapping(string $platform): LogisticTypeMappingApi
    {
        $query = [
            'platform' => $platform,
        ];

        $response = $this->get("/integration/orders/logistic-type-mapping", $query);

        return $this->getClient()->getServiceProvider()->create(
            LogisticTypeMappingApi::class,
            $response
        );
    }
}
