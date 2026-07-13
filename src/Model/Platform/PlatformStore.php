<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Model\AbstractModel;

class PlatformStore extends AbstractModel
{
    protected ?string $platform = null;

    protected ?string $store = null;

    public function __construct(
        ?string $platform = null,
        ?string $store = null
    ) {
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($store !== null) {
            $this->setStore($store);
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

    public function getStore(): ?string
    {
        return $this->store;
    }

    public function setStore(?string $store): self
    {
        $this->store = $store;
        return $this;
    }
}
