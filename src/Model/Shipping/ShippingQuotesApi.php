<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Shipping;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Shipping\ShippingQuoteApi;

use function is_array;

class ShippingQuotesApi extends AbstractModel
{
    protected int $postalCode;

    /** @var array<ShippingQuoteApi>|null */

    protected ?array $shippingQuotes = null;

    /**
     * @param array<ShippingQuoteApi|array<mixed>>|null $shippingQuotes
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        int $postalCode,
        ?array $shippingQuotes = null
    ) {
        $this->setPostalCode($postalCode);
        if ($shippingQuotes !== null) {
            foreach ($shippingQuotes as $key => $value) {
                if (is_array($value)) {
                    $shippingQuotes[$key] = $serviceProvider->create(
                        ShippingQuoteApi::class,
                        $value
                    );
                }
            }
            $this->setShippingQuotes($shippingQuotes);
        }
    }

    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return array<ShippingQuoteApi>|null
     */
    public function getShippingQuotes(): ?array
    {
        return $this->shippingQuotes;
    }

    /**
     * @param array<ShippingQuoteApi> $shippingQuotes
     */
    public function setShippingQuotes(?array $shippingQuotes): self
    {
        if ($shippingQuotes !== null) {
            $this->validateArrayElements($shippingQuotes, ShippingQuoteApi::class);
        }
        $this->shippingQuotes = $shippingQuotes;
        return $this;
    }
}
