<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Tag;

use Gubee\SDK\Model\AbstractModel;

class CreateTagResponseApi extends AbstractModel
{
    protected ?string $message = null;

    public function __construct(
        ?string $message = null
    ) {
        if ($message !== null) {
            $this->setMessage($message);
        }
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
