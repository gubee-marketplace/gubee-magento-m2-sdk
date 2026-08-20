<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class OrderNote extends AbstractModel
{
    protected bool $success;

    /** @var array<string> */

    protected array $orderIds;

    protected ?string $errorMessage = null;

    /**
     * @param array<string> $orderIds
     */
    public function __construct(
        bool $success,
        array $orderIds,
        ?string $errorMessage = null
    ) {
        $this->setSuccess($success);
        $this->setOrderIds($orderIds);
        if ($errorMessage !== null) {
            $this->setErrorMessage($errorMessage);
        }
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getOrderIds(): array
    {
        return $this->orderIds;
    }

    /**
     * @param array<string> $orderIds
     */
    public function setOrderIds(array $orderIds): self
    {
        $this->validateArrayElements($orderIds, 'string');
        $this->orderIds = $orderIds;
        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}
