<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\AbstractModel;

class PatchImageMetadata extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?string $name = null;

    protected ?int $order = null;

    protected ?string $localUrl = null;

    protected ?string $imageFileName = null;

    public function __construct(
        ?string $sellerId = null,
        ?string $name = null,
        ?int $order = null,
        ?string $localUrl = null,
        ?string $imageFileName = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($order !== null) {
            $this->setOrder($order);
        }
        if ($localUrl !== null) {
            $this->setLocalUrl($localUrl);
        }
        if ($imageFileName !== null) {
            $this->setImageFileName($imageFileName);
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

    public function getLocalUrl(): ?string
    {
        return $this->localUrl;
    }

    public function setLocalUrl(?string $localUrl): self
    {
        $this->localUrl = $localUrl;
        return $this;
    }

    public function getImageFileName(): ?string
    {
        return $this->imageFileName;
    }

    public function setImageFileName(?string $imageFileName): self
    {
        $this->imageFileName = $imageFileName;
        return $this;
    }
}
