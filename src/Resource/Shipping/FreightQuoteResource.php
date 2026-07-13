<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Shipping;

use Gubee\SDK\Model\Shipping\ShippingQuotesApi;
use Gubee\SDK\Model\Shipping\SkuFreightsApi;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class FreightQuoteResource extends AbstractResource
{
    public function quote(string $sellerId, int $postalCode, SkuFreightsApi|array $payload): ShippingQuotesApi
    {
        $response = $this->post("/integration/quotes/" . rawurlencode($sellerId) . "/" . rawurlencode((string) $postalCode) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            ShippingQuotesApi::class,
            $response
        );
    }
}
