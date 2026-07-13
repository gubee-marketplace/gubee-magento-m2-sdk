<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Tag;

use Gubee\SDK\Model\AbstractModel;

class PackageErrorApi extends AbstractModel
{
    protected string $orderId;

    protected ?string $message = null;

    protected ?string $messageDescription = null;

    protected ?array $parameters = null;

    public function __construct(
        string $orderId,
        ?string $message = null,
        ?string $messageDescription = null,
        ?array $parameters = null
    ) {
        $this->setOrderId($orderId);
        if ($message !== null) {
            $this->setMessage($message);
        }
        if ($messageDescription !== null) {
            $this->setMessageDescription($messageDescription);
        }
        if ($parameters !== null) {
            $this->setParameters($parameters);
        }
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getMessageDescription(): ?string
    {
        return $this->messageDescription;
    }

    public function setMessageDescription(?string $messageDescription): self
    {
        $this->messageDescription = $messageDescription;
        return $this;
    }

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function setParameters(?array $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }
}
