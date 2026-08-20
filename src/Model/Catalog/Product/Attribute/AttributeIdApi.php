<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\AbstractModel;

class AttributeIdApi extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $hubeeId = null;

    public function __construct(
        ?string $id = null,
        ?string $hubeeId = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($hubeeId !== null) {
            $this->setHubeeId($hubeeId);
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

    public function getHubeeId(): ?string
    {
        return $this->hubeeId;
    }

    public function setHubeeId(?string $hubeeId): self
    {
        $this->hubeeId = $hubeeId;
        return $this;
    }
}
