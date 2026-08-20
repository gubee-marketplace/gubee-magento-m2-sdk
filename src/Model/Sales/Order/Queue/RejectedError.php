<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order\Queue;

use Gubee\SDK\Model\AbstractModel;

class RejectedError extends AbstractModel
{
    protected string $message;

    protected string $reason;

    public function __construct(
        string $message,
        string $reason
    ) {
        $this->setMessage($message);
        $this->setReason($reason);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }
}
