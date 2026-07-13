<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Notification;

use Gubee\SDK\Model\AbstractModel;

class NotificationResponseApi extends AbstractModel
{
    protected ?int $httpStatus = null;

    protected ?string $body = null;

    public function __construct(
        ?int $httpStatus = null,
        ?string $body = null
    ) {
        if ($httpStatus !== null) {
            $this->setHttpStatus($httpStatus);
        }
        if ($body !== null) {
            $this->setBody($body);
        }
    }

    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }

    public function setHttpStatus(?int $httpStatus): self
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;
        return $this;
    }
}
