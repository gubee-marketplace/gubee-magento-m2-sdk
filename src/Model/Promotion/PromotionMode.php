<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Promotion;

use Gubee\SDK\Enum\Promotion\ModeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class PromotionMode extends AbstractModel
{
    protected ?ModeEnum $mode = null;

    protected ?float $value = null;

    public function __construct(
        ModeEnum|string|null $mode = null,
        ?float $value = null
    ) {
        if ($mode !== null) {
            if (is_string($mode)) {
                $mode = ModeEnum::fromValue($mode);
            }
            $this->setMode($mode);
        }
        if ($value !== null) {
            $this->setValue($value);
        }
    }

    public function getMode(): ?ModeEnum
    {
        return $this->mode;
    }

    public function setMode(?ModeEnum $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;
        return $this;
    }
}
