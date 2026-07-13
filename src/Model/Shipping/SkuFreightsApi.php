<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Shipping;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Shipping\SkuFreightApi;

use function is_array;

class SkuFreightsApi extends AbstractModel
{
    /** @var array<SkuFreightApi>|null */

    protected ?array $quotationItems = null;

    /**
     * @param array<SkuFreightApi|array<mixed>>|null $quotationItems
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?array $quotationItems = null
    ) {
        if ($quotationItems !== null) {
            foreach ($quotationItems as $key => $value) {
                if (is_array($value)) {
                    $quotationItems[$key] = $serviceProvider->create(
                        SkuFreightApi::class,
                        $value
                    );
                }
            }
            $this->setQuotationItems($quotationItems);
        }
    }

    /**
     * @return array<SkuFreightApi>|null
     */
    public function getQuotationItems(): ?array
    {
        return $this->quotationItems;
    }

    /**
     * @param array<SkuFreightApi> $quotationItems
     */
    public function setQuotationItems(?array $quotationItems): self
    {
        if ($quotationItems !== null) {
            $this->validateArrayElements($quotationItems, SkuFreightApi::class);
        }
        $this->quotationItems = $quotationItems;
        return $this;
    }
}
