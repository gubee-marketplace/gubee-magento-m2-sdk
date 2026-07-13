<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Video;

use Gubee\SDK\Enum\Video\OwnerTypeEnum;
use Gubee\SDK\Enum\Video\StatusEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class VideoCommit extends AbstractModel
{
    protected ?string $videoId = null;

    protected ?string $sellerId = null;

    protected ?OwnerTypeEnum $ownerType = null;

    protected ?string $ownerId = null;

    protected ?StatusEnum $status = null;

    public function __construct(
        ?string $videoId = null,
        ?string $sellerId = null,
        OwnerTypeEnum|string|null $ownerType = null,
        ?string $ownerId = null,
        StatusEnum|string|null $status = null
    ) {
        if ($videoId !== null) {
            $this->setVideoId($videoId);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($ownerType !== null) {
            if (is_string($ownerType)) {
                $ownerType = OwnerTypeEnum::fromValue($ownerType);
            }
            $this->setOwnerType($ownerType);
        }
        if ($ownerId !== null) {
            $this->setOwnerId($ownerId);
        }
        if ($status !== null) {
            if (is_string($status)) {
                $status = StatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }
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

    public function getOwnerType(): ?OwnerTypeEnum
    {
        return $this->ownerType;
    }

    public function setOwnerType(?OwnerTypeEnum $ownerType): self
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

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(?StatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }
}
