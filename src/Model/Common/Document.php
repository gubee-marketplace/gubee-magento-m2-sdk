<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Enum\Common\DocumentTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class Document extends AbstractModel
{
    protected ?string $number = null;

    protected ?DocumentTypeEnum $type = null;

    protected ?string $id = null;

    protected ?string $value = null;

    public function __construct(
        ?string $number = null,
        DocumentTypeEnum|string|null $type = null,
        ?string $id = null,
        ?string $value = null
    ) {
        if ($number !== null) {
            $this->setNumber($number);
        }
        if ($type !== null) {
            if (is_string($type)) {
                $type = DocumentTypeEnum::fromValue($type);
            }
            $this->setType($type);
        }
        if ($id !== null) {
            $this->setId($id);
        }
        if ($value !== null) {
            $this->setValue($value);
        }
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getType(): ?DocumentTypeEnum
    {
        return $this->type;
    }

    public function setType(?DocumentTypeEnum $type): self
    {
        $this->type = $type;
        return $this;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
