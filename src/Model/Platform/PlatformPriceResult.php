<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Model\AbstractModel;

class PlatformPriceResult extends AbstractModel
{
    protected ?string $platform = null;

    protected ?string $itemId = null;

    protected ?bool $updated = null;

    protected ?string $message = null;

    public function __construct(
        ?string $platform = null,
        ?string $itemId = null,
        ?bool $updated = null,
        ?string $message = null
    ) {
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($itemId !== null) {
            $this->setItemId($itemId);
        }
        if ($updated !== null) {
            $this->setUpdated($updated);
        }
        if ($message !== null) {
            $this->setMessage($message);
        }
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(?string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getUpdated(): ?bool
    {
        return $this->updated;
    }

    public function setUpdated(?bool $updated): self
    {
        $this->updated = $updated;
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
}
