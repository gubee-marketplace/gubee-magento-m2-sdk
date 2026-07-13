<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Promotion;

use Gubee\SDK\Enum\Promotion\StatusEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class PromotionStatus extends AbstractModel
{
    protected ?StatusEnum $status = null;

    public function __construct(
        StatusEnum|string|null $status = null
    ) {
        if ($status !== null) {
            if (is_string($status)) {
                $status = StatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }
    }

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(?StatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }
}
