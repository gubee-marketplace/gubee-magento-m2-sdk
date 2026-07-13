<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class PlatformPricePeriod extends AbstractModel
{
    protected ?DateTimeInterface $beginDt = null;

    protected ?DateTimeInterface $endDt = null;

    public function __construct(
        DateTimeInterface|string|null $beginDt = null,
        DateTimeInterface|string|null $endDt = null
    ) {
        if ($beginDt !== null) {
            if (! $beginDt instanceof DateTimeInterface) {
                $beginDt = new DateTime($beginDt);
            }
            $this->setBeginDt($beginDt);
        }
        if ($endDt !== null) {
            if (! $endDt instanceof DateTimeInterface) {
                $endDt = new DateTime($endDt);
            }
            $this->setEndDt($endDt);
        }
    }

    public function getBeginDt(): ?DateTimeInterface
    {
        return $this->beginDt;
    }

    public function setBeginDt(?DateTimeInterface $beginDt): self
    {
        $this->beginDt = $beginDt;
        return $this;
    }

    public function getEndDt(): ?DateTimeInterface
    {
        return $this->endDt;
    }

    public function setEndDt(?DateTimeInterface $endDt): self
    {
        $this->endDt = $endDt;
        return $this;
    }
}
