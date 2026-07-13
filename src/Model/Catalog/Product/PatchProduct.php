<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Ad\OriginEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\OriginCountry;

use function is_array;
use function is_string;

class PatchProduct extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?string $name = null;

    protected ?string $nbm = null;

    protected ?OriginEnum $origin = null;

    protected ?OriginCountry $originCountry = null;

    protected ?bool $disableIntegration = null;

    /**
     * @param OriginCountry|array<mixed>|null $originCountry
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $sellerId = null,
        ?string $name = null,
        ?string $nbm = null,
        OriginEnum|string|null $origin = null,
        OriginCountry|array|null $originCountry = null,
        ?bool $disableIntegration = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($nbm !== null) {
            $this->setNbm($nbm);
        }
        if ($origin !== null) {
            if (is_string($origin)) {
                $origin = OriginEnum::fromValue($origin);
            }
            $this->setOrigin($origin);
        }
        if ($originCountry !== null) {
            if (is_array($originCountry)) {
                $originCountry = $serviceProvider->create(
                    OriginCountry::class,
                    $originCountry
                );
            }
            $this->setOriginCountry($originCountry);
        }
        if ($disableIntegration !== null) {
            $this->setDisableIntegration($disableIntegration);
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

    public function getNbm(): ?string
    {
        return $this->nbm;
    }

    public function setNbm(?string $nbm): self
    {
        $this->nbm = $nbm;
        return $this;
    }

    public function getOrigin(): ?OriginEnum
    {
        return $this->origin;
    }

    public function setOrigin(?OriginEnum $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    public function getOriginCountry(): ?OriginCountry
    {
        return $this->originCountry;
    }

    public function setOriginCountry(?OriginCountry $originCountry): self
    {
        $this->originCountry = $originCountry;
        return $this;
    }

    public function getDisableIntegration(): ?bool
    {
        return $this->disableIntegration;
    }

    public function setDisableIntegration(?bool $disableIntegration): self
    {
        $this->disableIntegration = $disableIntegration;
        return $this;
    }
}
