<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Model\AbstractModel;

class AddImageRequest extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?string $url = null;

    protected ?string $uuid = null;

    protected ?string $name = null;

    protected ?int $order = null;

    protected ?bool $main = null;

    protected ?bool $importedByApi = null;

    public function __construct(
        ?string $sellerId = null,
        ?string $url = null,
        ?string $uuid = null,
        ?string $name = null,
        ?int $order = null,
        ?bool $main = null,
        ?bool $importedByApi = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($url !== null) {
            $this->setUrl($url);
        }
        if ($uuid !== null) {
            $this->setUuid($uuid);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($order !== null) {
            $this->setOrder($order);
        }
        if ($main !== null) {
            $this->setMain($main);
        }
        if ($importedByApi !== null) {
            $this->setImportedByApi($importedByApi);
        }
    }

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function getMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(?bool $main): self
    {
        $this->main = $main;
        return $this;
    }

    public function getImportedByApi(): ?bool
    {
        return $this->importedByApi;
    }

    public function setImportedByApi(?bool $importedByApi): self
    {
        $this->importedByApi = $importedByApi;
        return $this;
    }
}
