<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Tag;

use Gubee\SDK\Model\AbstractModel;

class PackApi extends AbstractModel
{
    protected string $link;

    protected string $type;

    public function __construct(
        string $link,
        string $type
    ) {
        $this->setLink($link);
        $this->setType($type);
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
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
}
