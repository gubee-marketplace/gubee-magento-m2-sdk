<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Notification;

use Gubee\SDK\Enum\Notification\NotificationTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class IntegrationNotification extends AbstractModel
{
    protected ?string $sourceId = null;

    protected ?string $plataform = null;

    protected ?string $type = null;

    protected ?string $message = null;

    protected ?string $reason = null;

    protected ?bool $keyMessage = null;

    protected ?NotificationTypeEnum $notificationType = null;

    public function __construct(
        ?string $sourceId = null,
        ?string $plataform = null,
        ?string $type = null,
        ?string $message = null,
        ?string $reason = null,
        ?bool $keyMessage = null,
        NotificationTypeEnum|string|null $notificationType = null
    ) {
        if ($sourceId !== null) {
            $this->setSourceId($sourceId);
        }
        if ($plataform !== null) {
            $this->setPlataform($plataform);
        }
        if ($type !== null) {
            $this->setType($type);
        }
        if ($message !== null) {
            $this->setMessage($message);
        }
        if ($reason !== null) {
            $this->setReason($reason);
        }
        if ($keyMessage !== null) {
            $this->setKeyMessage($keyMessage);
        }
        if ($notificationType !== null) {
            if (is_string($notificationType)) {
                $notificationType = NotificationTypeEnum::fromValue($notificationType);
            }
            $this->setNotificationType($notificationType);
        }
    }

    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    public function setSourceId(?string $sourceId): self
    {
        $this->sourceId = $sourceId;
        return $this;
    }

    public function getPlataform(): ?string
    {
        return $this->plataform;
    }

    public function setPlataform(?string $plataform): self
    {
        $this->plataform = $plataform;
        return $this;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    public function getKeyMessage(): ?bool
    {
        return $this->keyMessage;
    }

    public function setKeyMessage(?bool $keyMessage): self
    {
        $this->keyMessage = $keyMessage;
        return $this;
    }

    public function getNotificationType(): ?NotificationTypeEnum
    {
        return $this->notificationType;
    }

    public function setNotificationType(?NotificationTypeEnum $notificationType): self
    {
        $this->notificationType = $notificationType;
        return $this;
    }
}
