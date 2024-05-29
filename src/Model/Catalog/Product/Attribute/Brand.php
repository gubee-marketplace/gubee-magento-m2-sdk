<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute;

use Exception;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use InvalidArgumentException;

class Brand extends AbstractModel
{
    protected string $name;
    protected ?string $description = null;
    protected ?string $hubeeId     = null;
    protected ?string $id          = null;
    protected BrandResource $brandResource;

    public function __construct(
        BrandResource $brandResource,
        string $name,
        ?string $description = null,
        ?string $hubeeId = null,
        ?string $id = null
    ) {
        $this->brandResource = $brandResource;
        $this->setName($name);
        if ($description) {
            $this->setDescription($description);
        }
        if ($hubeeId) {
            $this->setHubeeId($hubeeId);
        }
        if ($id) {
            $this->setId($id);
        }
    }

    public function load(
        $id,
        $field = 'name'
    ): Brand {
        switch ($field) {
            case 'name':
                return $this->brandResource->loadByName($id);
            case 'externalId':
                return $this->brandResource->loadByExternalId($id);
            case 'id':
                return $this->brandResource->loadById($id);
            default:
                throw new InvalidArgumentException('Invalid field');
        }
    }

    public function save(): Brand
    {
        if ($this->getHubeeId()) {
            return $this->brandResource->updateById($this);
        } elseif ($this->getId()) {
            return $this->brandResource->updateByExternalId($this);
        }
        try {
            $this->brandResource->loadByName($this->getName());
        } catch (Exception $e) {
            return $this->brandResource->create($this);
        }
        return $this->brandResource->updateByName($this);
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getHubeeId(): ?string
    {
        return $this->hubeeId;
    }

    public function setHubeeId(?string $hubeeId)
    {
        $this->hubeeId = $hubeeId;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function jsonSerialize(): array
    {
        $values = parent::jsonSerialize();
        if (isset($values['brandResource'])) {
            unset($values['brandResource']);
        }

        return $values;
    }
}
