<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class DeliveredOrderApi extends AbstractModel
{
    protected DateTimeInterface $deliveredDt;

    public function __construct(
        DateTimeInterface|string $deliveredDt
    ) {
        if (! $deliveredDt instanceof DateTimeInterface) {
            $deliveredDt = new DateTime($deliveredDt);
        }
        $this->setDeliveredDt($deliveredDt);
    }

    public function getDeliveredDt(): DateTimeInterface
    {
        return $this->deliveredDt;
    }

    public function setDeliveredDt(DateTimeInterface $deliveredDt): self
    {
        $this->deliveredDt = $deliveredDt;
        return $this;
    }
}
