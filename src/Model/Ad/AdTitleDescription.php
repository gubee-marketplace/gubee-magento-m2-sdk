<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Model\AbstractModel;

class AdTitleDescription extends AbstractModel
{
    protected ?string $title = null;

    protected ?string $description = null;

    public function __construct(
        ?string $title = null,
        ?string $description = null
    ) {
        if ($title !== null) {
            $this->setTitle($title);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
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
}
