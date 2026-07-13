<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Promotion;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\ValidityPeriod;
use Gubee\SDK\Model\Promotion\PromotionMode;
use Gubee\SDK\Model\Promotion\PromotionStatus;

use function is_array;
use function is_string;

class Promotion extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $name = null;

    protected ?string $sellerId = null;

    protected ?PromotionStatus $status = null;

    protected ?string $description = null;

    protected ?ValidityPeriod $period = null;

    protected ?int $priority = null;

    /** @var array<PromotionMode>|null */

    protected ?array $modes = null;

    protected ?bool $deleted = null;

    protected ?bool $related = null;

    protected ?DomainTypeEnum $domainType = null;

    protected ?DateTimeInterface $startOffsetDt = null;

    protected ?DateTimeInterface $endOffsetDt = null;

    protected ?bool $useVariantRules = null;

    protected ?string $platform = null;

    /**
     * @param PromotionStatus|array<mixed>|null $status
     * @param ValidityPeriod|array<mixed>|null $period
     * @param array<PromotionMode|array<mixed>>|null $modes
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $id = null,
        ?string $name = null,
        ?string $sellerId = null,
        PromotionStatus|array|null $status = null,
        ?string $description = null,
        ValidityPeriod|array|null $period = null,
        ?int $priority = null,
        ?array $modes = null,
        ?bool $deleted = null,
        ?bool $related = null,
        DomainTypeEnum|string|null $domainType = null,
        DateTimeInterface|string|null $startOffsetDt = null,
        DateTimeInterface|string|null $endOffsetDt = null,
        ?bool $useVariantRules = null,
        ?string $platform = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($status !== null) {
            if (is_array($status)) {
                $status = $serviceProvider->create(
                    PromotionStatus::class,
                    $status
                );
            }
            $this->setStatus($status);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($period !== null) {
            if (is_array($period)) {
                $period = $serviceProvider->create(
                    ValidityPeriod::class,
                    $period
                );
            }
            $this->setPeriod($period);
        }
        if ($priority !== null) {
            $this->setPriority($priority);
        }
        if ($modes !== null) {
            foreach ($modes as $key => $value) {
                if (is_array($value)) {
                    $modes[$key] = $serviceProvider->create(
                        PromotionMode::class,
                        $value
                    );
                }
            }
            $this->setModes($modes);
        }
        if ($deleted !== null) {
            $this->setDeleted($deleted);
        }
        if ($related !== null) {
            $this->setRelated($related);
        }
        if ($domainType !== null) {
            if (is_string($domainType)) {
                $domainType = DomainTypeEnum::fromValue($domainType);
            }
            $this->setDomainType($domainType);
        }
        if ($startOffsetDt !== null) {
            if (! $startOffsetDt instanceof DateTimeInterface) {
                $startOffsetDt = new DateTime($startOffsetDt);
            }
            $this->setStartOffsetDt($startOffsetDt);
        }
        if ($endOffsetDt !== null) {
            if (! $endOffsetDt instanceof DateTimeInterface) {
                $endOffsetDt = new DateTime($endOffsetDt);
            }
            $this->setEndOffsetDt($endOffsetDt);
        }
        if ($useVariantRules !== null) {
            $this->setUseVariantRules($useVariantRules);
        }
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
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

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getStatus(): ?PromotionStatus
    {
        return $this->status;
    }

    public function setStatus(?PromotionStatus $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPeriod(): ?ValidityPeriod
    {
        return $this->period;
    }

    public function setPeriod(?ValidityPeriod $period): self
    {
        $this->period = $period;
        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return array<PromotionMode>|null
     */
    public function getModes(): ?array
    {
        return $this->modes;
    }

    /**
     * @param array<PromotionMode> $modes
     */
    public function setModes(?array $modes): self
    {
        if ($modes !== null) {
            $this->validateArrayElements($modes, PromotionMode::class);
        }
        $this->modes = $modes;
        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(?bool $deleted): self
    {
        $this->deleted = $deleted;
        return $this;
    }

    public function getRelated(): ?bool
    {
        return $this->related;
    }

    public function setRelated(?bool $related): self
    {
        $this->related = $related;
        return $this;
    }

    public function getDomainType(): ?DomainTypeEnum
    {
        return $this->domainType;
    }

    public function setDomainType(?DomainTypeEnum $domainType): self
    {
        $this->domainType = $domainType;
        return $this;
    }

    public function getStartOffsetDt(): ?DateTimeInterface
    {
        return $this->startOffsetDt;
    }

    public function setStartOffsetDt(?DateTimeInterface $startOffsetDt): self
    {
        $this->startOffsetDt = $startOffsetDt;
        return $this;
    }

    public function getEndOffsetDt(): ?DateTimeInterface
    {
        return $this->endOffsetDt;
    }

    public function setEndOffsetDt(?DateTimeInterface $endOffsetDt): self
    {
        $this->endOffsetDt = $endOffsetDt;
        return $this;
    }

    public function getUseVariantRules(): ?bool
    {
        return $this->useVariantRules;
    }

    public function setUseVariantRules(?bool $useVariantRules): self
    {
        $this->useVariantRules = $useVariantRules;
        return $this;
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
}
