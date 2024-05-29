<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Library\HttpClient\Exception\NotFoundException;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Resource\Catalog\CategoryResource;

use function is_int;

class Category extends AbstractModel
{
    protected $id;
    protected $name;
    protected $active                 = null;
    protected $description          = null;
    protected $enabledAutoIntegration = null;
    protected $hubeeId              = null;
    protected $parent             = null;
    protected $categoryResource;
    protected $serviceProvider;

    /**
     * @var int|Category $parent
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        CategoryResource $categoryResource,
        string $id,
        ?string $name = null,
        ?bool $active = null,
        ?string $description = null,
        ?bool $enabledAutoIntegration = null,
        ?string $hubeeId = null,
        $parent = null
    ) {
        $this->serviceProvider  = $serviceProvider;
        $this->categoryResource = $categoryResource;
        $this->setId($id);
        if ($name) {
            $this->setName($name);
        }
        if ($active !== null) {
            $this->setActive($active);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($enabledAutoIntegration !== null) {
            $this->setEnabledAutoIntegration($enabledAutoIntegration);
        }
        if ($hubeeId !== null) {
            $this->setHubeeId($hubeeId);
        }
        if ($parent !== null) {
            $this->setParent($parent);
        }
    }

    public function save(): Category
    {
        try {
            $this->categoryResource->loadByExternalId($this->getId());
            return $this->categoryResource->updateByExternalId($this->getId(), $this);
        } catch (NotFoundException $e) {
            return $this->categoryResource->create($this);
        }
    }

    public function load(string $id)
    {
        return $this->categoryResource->loadByExternalId($id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
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

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active)
    {
        $this->active = $active;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getEnabledAutoIntegration(): bool
    {
        return $this->enabledAutoIntegration;
    }

    public function setEnabledAutoIntegration(bool $enabledAutoIntegration)
    {
        $this->enabledAutoIntegration = $enabledAutoIntegration;
        return $this;
    }

    public function getHubeeId(): string
    {
        return $this->hubeeId;
    }

    public function setHubeeId(string $hubeeId)
    {
        $this->hubeeId = $hubeeId;
        return $this;
    }

    public function getParent(): Category
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        if (is_int($parent)) {
            $parent = $this->serviceProvider->create(
                self::class,
                [
                    'serviceProvider'  => $this->serviceProvider,
                    'categoryResource' => $this->categoryResource,
                    'id'               => $parent,
                ]
            );
        }
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return array<int|string, mixed>
     */
    public function jsonSerialize(): array
    {
        $values = parent::jsonSerialize();
        if (isset($values['parent'])) {
            $values['parent'] = $values['parent']->getId();
        }

        if (isset($values['serviceProvider'])) {
            unset($values['serviceProvider']);
        }
        if (isset($values['categoryResource'])) {
            unset($values['categoryResource']);
        }

        return $values;
    }
}
