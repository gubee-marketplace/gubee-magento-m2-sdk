<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class CanceledOrderApi extends AbstractModel
{
    protected DateTimeInterface $cancelDt;

    public function __construct(
        DateTimeInterface|string $cancelDt
    ) {
        if (! $cancelDt instanceof DateTimeInterface) {
            $cancelDt = new DateTime($cancelDt);
        }
        $this->setCancelDt($cancelDt);
    }

    public function getCancelDt(): DateTimeInterface
    {
        return $this->cancelDt;
    }

    public function setCancelDt(DateTimeInterface $cancelDt): self
    {
        $this->cancelDt = $cancelDt;
        return $this;
    }
}
