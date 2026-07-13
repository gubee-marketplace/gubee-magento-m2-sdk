<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Video;

use Gubee\SDK\Model\AbstractModel;

class VideoApi extends AbstractModel
{
    protected bool $main;

    protected ?string $name = null;

    protected int $order;

    protected string $url;

    protected ?string $uuid = null;

    protected ?string $videoId = null;

    protected ?string $cdnUrl = null;

    protected ?string $posterUrl = null;

    protected ?int $durationMs = null;

    protected ?int $width = null;

    protected ?int $height = null;

    protected ?int $sizeBytes = null;

    protected ?string $status = null;

    protected ?string $failureReason = null;

    public function __construct(
        bool $main,
        ?string $name = null,
        int $order = 0,
        string $url = '',
        ?string $uuid = null,
        ?string $videoId = null,
        ?string $cdnUrl = null,
        ?string $posterUrl = null,
        ?int $durationMs = null,
        ?int $width = null,
        ?int $height = null,
        ?int $sizeBytes = null,
        ?string $status = null,
        ?string $failureReason = null
    ) {
        $this->setMain($main);
        if ($name !== null) {
            $this->setName($name);
        }
        $this->setOrder($order);
        $this->setUrl($url);
        if ($uuid !== null) {
            $this->setUuid($uuid);
        }
        if ($videoId !== null) {
            $this->setVideoId($videoId);
        }
        if ($cdnUrl !== null) {
            $this->setCdnUrl($cdnUrl);
        }
        if ($posterUrl !== null) {
            $this->setPosterUrl($posterUrl);
        }
        if ($durationMs !== null) {
            $this->setDurationMs($durationMs);
        }
        if ($width !== null) {
            $this->setWidth($width);
        }
        if ($height !== null) {
            $this->setHeight($height);
        }
        if ($sizeBytes !== null) {
            $this->setSizeBytes($sizeBytes);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        if ($failureReason !== null) {
            $this->setFailureReason($failureReason);
        }
    }

    public function getMain(): bool
    {
        return $this->main;
    }

    public function setMain(bool $main): self
    {
        $this->main = $main;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): self
    {
        $this->order = $order;
        return $this;
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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    public function setVideoId(?string $videoId): self
    {
        $this->videoId = $videoId;
        return $this;
    }

    public function getCdnUrl(): ?string
    {
        return $this->cdnUrl;
    }

    public function setCdnUrl(?string $cdnUrl): self
    {
        $this->cdnUrl = $cdnUrl;
        return $this;
    }

    public function getPosterUrl(): ?string
    {
        return $this->posterUrl;
    }

    public function setPosterUrl(?string $posterUrl): self
    {
        $this->posterUrl = $posterUrl;
        return $this;
    }

    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }

    public function setDurationMs(?int $durationMs): self
    {
        $this->durationMs = $durationMs;
        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getSizeBytes(): ?int
    {
        return $this->sizeBytes;
    }

    public function setSizeBytes(?int $sizeBytes): self
    {
        $this->sizeBytes = $sizeBytes;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getFailureReason(): ?string
    {
        return $this->failureReason;
    }

    public function setFailureReason(?string $failureReason): self
    {
        $this->failureReason = $failureReason;
        return $this;
    }
}
