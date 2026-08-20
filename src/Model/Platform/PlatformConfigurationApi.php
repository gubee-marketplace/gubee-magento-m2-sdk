<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Model\AbstractModel;

class PlatformConfigurationApi extends AbstractModel
{
    protected string $code;

    protected string $label;

    protected string $logoUrl;

    protected string $type;

    /** @var array<string>|null */

    protected ?array $publishType = null;

    protected array $orderStatus;

    /**
     * @param array<string>|null $publishType
     */
    public function __construct(
        string $code,
        string $label,
        string $logoUrl,
        string $type,
        ?array $publishType = null,
        array $orderStatus
    ) {
        $this->setCode($code);
        $this->setLabel($label);
        $this->setLogoUrl($logoUrl);
        $this->setType($type);
        if ($publishType !== null) {
            $this->setPublishType($publishType);
        }
        $this->setOrderStatus($orderStatus);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getPublishType(): ?array
    {
        return $this->publishType;
    }

    /**
     * @param array<string> $publishType
     */
    public function setPublishType(?array $publishType): self
    {
        if ($publishType !== null) {
            $this->validateArrayElements($publishType, 'string');
        }
        $this->publishType = $publishType;
        return $this;
    }

    public function getOrderStatus(): array
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(array $orderStatus): self
    {
        $this->orderStatus = $orderStatus;
        return $this;
    }
}
