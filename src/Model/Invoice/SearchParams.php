<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Sales\Order\AmbientEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class SearchParams extends AbstractModel
{
    protected ?string $type = null;

    protected ?string $storeId = null;

    /** @var array<string>|null */

    protected ?array $status = null;

    /** @var array<string>|null */

    protected ?array $orderIds = null;

    protected ?DateTimeInterface $startDt = null;

    protected ?DateTimeInterface $endDt = null;

    /** @var array<string>|null */

    protected ?array $orderStatus = null;

    protected ?AmbientEnum $ambient = null;

    protected ?string $region = null;

    /** @var array<string>|null */

    protected ?array $keys = null;

    /** @var array<int>|null */

    protected ?array $numbers = null;

    /** @var array<int>|null */

    protected ?array $series = null;

    /**
     * @param array<string>|null $status
     * @param array<string>|null $orderIds
     * @param array<string>|null $orderStatus
     * @param array<string>|null $keys
     * @param array<int>|null $numbers
     * @param array<int>|null $series
     */
    public function __construct(
        ?string $type = null,
        ?string $storeId = null,
        ?array $status = null,
        ?array $orderIds = null,
        DateTimeInterface|string|null $startDt = null,
        DateTimeInterface|string|null $endDt = null,
        ?array $orderStatus = null,
        AmbientEnum|string|null $ambient = null,
        ?string $region = null,
        ?array $keys = null,
        ?array $numbers = null,
        ?array $series = null
    ) {
        if ($type !== null) {
            $this->setType($type);
        }
        if ($storeId !== null) {
            $this->setStoreId($storeId);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        if ($orderIds !== null) {
            $this->setOrderIds($orderIds);
        }
        if ($startDt !== null) {
            if (! $startDt instanceof DateTimeInterface) {
                $startDt = new DateTime($startDt);
            }
            $this->setStartDt($startDt);
        }
        if ($endDt !== null) {
            if (! $endDt instanceof DateTimeInterface) {
                $endDt = new DateTime($endDt);
            }
            $this->setEndDt($endDt);
        }
        if ($orderStatus !== null) {
            $this->setOrderStatus($orderStatus);
        }
        if ($ambient !== null) {
            if (is_string($ambient)) {
                $ambient = AmbientEnum::fromValue($ambient);
            }
            $this->setAmbient($ambient);
        }
        if ($region !== null) {
            $this->setRegion($region);
        }
        if ($keys !== null) {
            $this->setKeys($keys);
        }
        if ($numbers !== null) {
            $this->setNumbers($numbers);
        }
        if ($series !== null) {
            $this->setSeries($series);
        }
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    public function setStoreId(?string $storeId): self
    {
        $this->storeId = $storeId;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getStatus(): ?array
    {
        return $this->status;
    }

    /**
     * @param array<string> $status
     */
    public function setStatus(?array $status): self
    {
        if ($status !== null) {
            $this->validateArrayElements($status, 'string');
        }
        $this->status = $status;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getOrderIds(): ?array
    {
        return $this->orderIds;
    }

    /**
     * @param array<string> $orderIds
     */
    public function setOrderIds(?array $orderIds): self
    {
        if ($orderIds !== null) {
            $this->validateArrayElements($orderIds, 'string');
        }
        $this->orderIds = $orderIds;
        return $this;
    }

    public function getStartDt(): ?DateTimeInterface
    {
        return $this->startDt;
    }

    public function setStartDt(?DateTimeInterface $startDt): self
    {
        $this->startDt = $startDt;
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

    /**
     * @return array<string>|null
     */
    public function getOrderStatus(): ?array
    {
        return $this->orderStatus;
    }

    /**
     * @param array<string> $orderStatus
     */
    public function setOrderStatus(?array $orderStatus): self
    {
        if ($orderStatus !== null) {
            $this->validateArrayElements($orderStatus, 'string');
        }
        $this->orderStatus = $orderStatus;
        return $this;
    }

    public function getAmbient(): ?AmbientEnum
    {
        return $this->ambient;
    }

    public function setAmbient(?AmbientEnum $ambient): self
    {
        $this->ambient = $ambient;
        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getKeys(): ?array
    {
        return $this->keys;
    }

    /**
     * @param array<string> $keys
     */
    public function setKeys(?array $keys): self
    {
        if ($keys !== null) {
            $this->validateArrayElements($keys, 'string');
        }
        $this->keys = $keys;
        return $this;
    }

    /**
     * @return array<int>|null
     */
    public function getNumbers(): ?array
    {
        return $this->numbers;
    }

    /**
     * @param array<int> $numbers
     */
    public function setNumbers(?array $numbers): self
    {
        if ($numbers !== null) {
            $this->validateArrayElements($numbers, 'int');
        }
        $this->numbers = $numbers;
        return $this;
    }

    /**
     * @return array<int>|null
     */
    public function getSeries(): ?array
    {
        return $this->series;
    }

    /**
     * @param array<int> $series
     */
    public function setSeries(?array $series): self
    {
        if ($series !== null) {
            $this->validateArrayElements($series, 'int');
        }
        $this->series = $series;
        return $this;
    }
}
