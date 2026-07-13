<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Model\AbstractModel;

class SetUp extends AbstractModel
{
    protected ?string $up = null;

    public function __construct(
        ?string $up = null
    ) {
        if ($up !== null) {
            $this->setUp($up);
        }
    }

    public function getUp(): ?string
    {
        return $this->up;
    }

    public function setUp(?string $up): self
    {
        $this->up = $up;
        return $this;
    }
}
