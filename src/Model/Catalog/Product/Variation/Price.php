<?php

declare (strict_types = 1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Variation\Price\TypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\ValidityPeriod;
use Gubee\SDK\Resource\Catalog\Product\Variation\PriceResource;

class Price extends AbstractModel {
    protected TypeEnum $type;
    protected float $value;
    protected ValidityPeriod $validityPeriod;
    protected PriceResource $priceResource;

    /**
     * @param string|TypeEnum $type
     * @param array|ValidityPeriod $validityPeriod
     */
    public function __construct(
        PriceResource $priceResource,
        ServiceProviderInterface $serviceProvider,
        $type,
        float $value,
        $validityPeriod = null
    ) {
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->priceResource = $priceResource;
        $this->setType($type);
        $this->setValue($value);
        if ($validityPeriod) {
            if (is_array($validityPeriod)) {
                $validityPeriod = $serviceProvider->create(
                    ValidityPeriod::class,
                    $validityPeriod
                );
            }
            $this->validityPeriod = $validityPeriod;
        }
    }

    public function save(string $productId, string $skuId) {
        $this->priceResource->updatePriceBySkuId(
            $productId,
            $skuId,
            $this
        );
    }

    public function getType(): TypeEnum {
        return $this->type;
    }

    public function setType(TypeEnum $type) {
        $this->type = $type;
        return $this;
    }

    public function getValue(): float {
        return $this->value;
    }

    public function setValue(float $value) {
        $this->value = $value;
        return $this;
    }

    public function getValidityPeriod(): ValidityPeriod {
        return $this->validityPeriod;
    }

    public function setValidityPeriod(ValidityPeriod $validityPeriod) {
        $this->validityPeriod = $validityPeriod;
        return $this;
    }
}
