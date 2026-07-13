<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class Tracking extends AbstractModel
{
    protected string $info;

    protected DateTimeInterface $trackDt;

    public function __construct(
        string $info,
        DateTimeInterface|string $trackDt
    ) {
        $this->setInfo($info);
        if (! $trackDt instanceof DateTimeInterface) {
            $trackDt = new DateTime($trackDt);
        }
        $this->setTrackDt($trackDt);
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;
        return $this;
    }

    public function getTrackDt(): DateTimeInterface
    {
        return $this->trackDt;
    }

    public function setTrackDt(DateTimeInterface $trackDt): self
    {
        $this->trackDt = $trackDt;
        return $this;
    }
}
