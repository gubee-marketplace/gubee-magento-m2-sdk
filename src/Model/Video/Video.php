<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Video;

use DateTimeInterface;
use Gubee\SDK\Enum\Video\StatusEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class Video extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $videoId = null;

    protected ?string $sellerId = null;

    protected ?StatusEnum $status = null;

    protected ?string $failureReason = null;

    protected ?string $cdnUrl = null;

    protected ?string $posterUrl = null;

    protected ?int $durationMs = null;

    protected ?int $width = null;

    protected ?int $height = null;

    protected ?int $sizeBytes = null;

    protected bool $main;

    protected ?string $name = null;

    protected int $order;

    protected ?string $ownerType = null;

    protected ?string $ownerId = null;

    protected ?DateTimeInterface $processedAt = null;

    protected ?string $url = null;

    /**
     * @param string|DateTimeInterface|null $processedAt
     */
    public function __construct(
        ?string $id = null,
        ?string $videoId = null,
        ?string $sellerId = null,
        StatusEnum|string|null $status = null,
        ?string $failureReason = null,
        ?string $cdnUrl = null,
        ?string $posterUrl = null,
        ?int $durationMs = null,
        ?int $width = null,
        ?int $height = null,
        ?int $sizeBytes = null,
        bool $main = false,
        ?string $name = null,
        int $order = 0,
        ?string $ownerType = null,
        ?string $ownerId = null,
        ?DateTimeInterface $processedAt = null,
        ?string $url = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($videoId !== null) {
            $this->setVideoId($videoId);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($status !== null) {
            if (is_string($status)) {
                $status = StatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }
        if ($failureReason !== null) {
            $this->setFailureReason($failureReason);
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
        $this->setMain($main);
        if ($name !== null) {
            $this->setName($name);
        }
        $this->setOrder($order);
        if ($ownerType !== null) {
            $this->setOwnerType($ownerType);
        }
        if ($ownerId !== null) {
            $this->setOwnerId($ownerId);
        }
        if ($processedAt !== null) {
            $this->setProcessedAt($processedAt);
        }
        if ($url !== null) {
            $this->setUrl($url);
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

    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    public function setVideoId(?string $videoId): self
    {
        $this->videoId = $videoId;
        return $this;
    }

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): self
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

    public function getOwnerType(): ?string
    {
        return $this->ownerType;
    }

    public function setOwnerType(?string $ownerType): self
    {
        $this->ownerType = $ownerType;
        return $this;
    }

    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    public function setOwnerId(?string $ownerId): self
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    public function getProcessedAt(): ?DateTimeInterface
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?DateTimeInterface $processedAt): self
    {
        $this->processedAt = $processedAt;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
