<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Video;

use Gubee\SDK\Enum\Video\OwnerTypeEnum;
use Gubee\SDK\Enum\Video\VideoTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class VideoUploadUrl extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?string $externalId = null;

    protected ?VideoTypeEnum $videoType = null;

    protected ?OwnerTypeEnum $ownerType = null;

    protected ?string $ownerId = null;

    protected ?int $expectedSizeBytes = null;

    protected ?string $videoId = null;

    protected ?string $uploadUrl = null;

    protected ?int $expiresAt = null;

    public function __construct(
        ?string $sellerId = null,
        ?string $externalId = null,
        VideoTypeEnum|string|null $videoType = null,
        OwnerTypeEnum|string|null $ownerType = null,
        ?string $ownerId = null,
        ?int $expectedSizeBytes = null,
        ?string $videoId = null,
        ?string $uploadUrl = null,
        ?int $expiresAt = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($externalId !== null) {
            $this->setExternalId($externalId);
        }
        if ($videoType !== null) {
            if (is_string($videoType)) {
                $videoType = VideoTypeEnum::fromValue($videoType);
            }
            $this->setVideoType($videoType);
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
        if ($expectedSizeBytes !== null) {
            $this->setExpectedSizeBytes($expectedSizeBytes);
        }
        if ($videoId !== null) {
            $this->setVideoId($videoId);
        }
        if ($uploadUrl !== null) {
            $this->setUploadUrl($uploadUrl);
        }
        if ($expiresAt !== null) {
            $this->setExpiresAt($expiresAt);
        }
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

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getVideoType(): ?VideoTypeEnum
    {
        return $this->videoType;
    }

    public function setVideoType(?VideoTypeEnum $videoType): self
    {
        $this->videoType = $videoType;
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

    public function getExpectedSizeBytes(): ?int
    {
        return $this->expectedSizeBytes;
    }

    public function setExpectedSizeBytes(?int $expectedSizeBytes): self
    {
        $this->expectedSizeBytes = $expectedSizeBytes;
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

    public function getUploadUrl(): ?string
    {
        return $this->uploadUrl;
    }

    public function setUploadUrl(?string $uploadUrl): self
    {
        $this->uploadUrl = $uploadUrl;
        return $this;
    }

    public function getExpiresAt(): ?int
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?int $expiresAt): self
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }
}
