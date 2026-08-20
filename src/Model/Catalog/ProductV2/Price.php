<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\ProductV2;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Variation\Price\TypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_array;
use function is_string;

class Price extends AbstractModel
{
    protected Cost $value;
    protected TypeEnum $type;

    /**
     * @param Cost|array<string, mixed> $value
     * @param TypeEnum|string $type
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        $value,
        $type
    ) {
        if (is_array($value)) {
            $value = $serviceProvider->create(Cost::class, $value);
        }
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->value = $value;
        $this->type  = $type;
    }

    public function getValue(): Cost
    {
        return $this->value;
    }

    public function setValue(Cost $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getType(): TypeEnum
    {
        return $this->type;
    }

    public function setType(TypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }
}
