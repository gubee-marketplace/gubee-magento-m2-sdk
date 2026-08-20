<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Model\AbstractModel;

class BlacklistPlatformApi extends AbstractModel
{
    protected string $name;

    protected string $status;

    public function __construct(
        string $name,
        string $status
    ) {
        $this->setName($name);
        $this->setStatus($status);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
