<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Notification;

use Gubee\SDK\Model\AbstractModel;

class NotificationRequestApi extends AbstractModel
{
    protected string $url;

    protected ?string $body = null;

    public function __construct(
        string $url,
        ?string $body = null
    ) {
        $this->setUrl($url);
        if ($body !== null) {
            $this->setBody($body);
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
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
