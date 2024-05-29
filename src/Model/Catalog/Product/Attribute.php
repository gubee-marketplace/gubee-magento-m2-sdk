<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Enum\Catalog\Product\Attribute\TypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class Attribute extends AbstractModel
{
    protected string $name;
    protected ?TypeEnum $attrType = null;
    protected ?string $hubeeId    = null;
    protected ?string $id         = null;
    protected ?string $label      = null;
    /** @var array<string> */
    protected ?array $options = null;
    protected ?bool $required = null;
    protected ?bool $variant  = null;

    /**
     * @param array<string>|null $options
     * @param TypeEnum|string|null $attrType
     */
    public function __construct(
        string $name,
        $attrType = null,
        ?string $hubeeId = null,
        ?string $id = null,
        ?string $label = null,
        ?array $options = null,
        ?bool $required = null,
        ?bool $variant = null
    ) {
        $this->setName($name);
        if ($attrType) {
            if (is_string($attrType)) {
                $attrType = TypeEnum::fromValue($attrType);
            }
            $this->setAttrType($attrType);
        }
        if ($hubeeId) {
            $this->setHubeeId($hubeeId);
        }
        if ($id) {
            $this->setId($id);
        }
        if ($label) {
            $this->setLabel($label);
        }
        if ($options) {
            $this->setOptions($options);
        }
        if ($required) {
            $this->setRequired($required);
        }
        if ($variant) {
            $this->setVariant($variant);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAttrType(): ?TypeEnum
    {
        return $this->attrType;
    }

    public function setAttrType(TypeEnum $attrType)
    {
        $this->attrType = $attrType;
        return $this;
    }

    public function getHubeeId(): ?string
    {
        return $this->hubeeId;
    }

    public function setHubeeId(string $hubeeId)
    {
        $this->hubeeId = $hubeeId;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param array<string> $options
     */
    public function setOptions(array $options)
    {
        $this->validateArrayElements(
            $options,
            'string'
        );
        $this->options = $options;
        return $this;
    }

    public function getRequired(): bool
    {
        return $this->required ?: false;
    }

    public function setRequired(bool $required)
    {
        $this->required = $required;
        return $this;
    }

    public function getVariant(): ?bool
    {
        return $this->variant;
    }

    public function setVariant(?bool $variant)
    {
        $this->variant = $variant;
        return $this;
    }
}
