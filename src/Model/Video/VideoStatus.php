<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Video;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Video\FailureReasonEnum;
use Gubee\SDK\Enum\Video\OwnerTypeEnum;
use Gubee\SDK\Enum\Video\StatusEnum;
use Gubee\SDK\Enum\Video\VideoTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Video\AppliedLimits;

use function is_array;
use function is_string;

class VideoStatus extends AbstractModel
{
    protected ?string $videoId = null;

    protected ?string $sellerId = null;

    protected ?StatusEnum $status = null;

    protected ?VideoTypeEnum $videoType = null;

    protected ?OwnerTypeEnum $ownerType = null;

    protected ?string $ownerId = null;

    protected ?string $cdnUrl = null;

    protected ?string $posterUrl = null;

    protected ?int $durationMs = null;

    protected ?int $width = null;

    protected ?int $height = null;

    protected ?int $sizeBytes = null;

    protected ?FailureReasonEnum $failureReason = null;

    protected ?string $failureDetail = null;

    protected ?AppliedLimits $limits = null;

    /**
     * @param AppliedLimits|array<mixed>|null $limits
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $videoId = null,
        ?string $sellerId = null,
        StatusEnum|string|null $status = null,
        VideoTypeEnum|string|null $videoType = null,
        OwnerTypeEnum|string|null $ownerType = null,
        ?string $ownerId = null,
        ?string $cdnUrl = null,
        ?string $posterUrl = null,
        ?int $durationMs = null,
        ?int $width = null,
        ?int $height = null,
        ?int $sizeBytes = null,
        FailureReasonEnum|string|null $failureReason = null,
        ?string $failureDetail = null,
        AppliedLimits|array|null $limits = null
    ) {
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
        if ($failureReason !== null) {
            if (is_string($failureReason)) {
                $failureReason = FailureReasonEnum::fromValue($failureReason);
            }
            $this->setFailureReason($failureReason);
        }
        if ($failureDetail !== null) {
            $this->setFailureDetail($failureDetail);
        }
        if ($limits !== null) {
            if (is_array($limits)) {
                $limits = $serviceProvider->create(
                    AppliedLimits::class,
                    $limits
                );
            }
            $this->setLimits($limits);
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

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(?StatusEnum $status): self
    {
        $this->status = $status;
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

    public function getFailureReason(): ?FailureReasonEnum
    {
        return $this->failureReason;
    }

    public function setFailureReason(?FailureReasonEnum $failureReason): self
    {
        $this->failureReason = $failureReason;
        return $this;
    }

    public function getFailureDetail(): ?string
    {
        return $this->failureDetail;
    }

    public function setFailureDetail(?string $failureDetail): self
    {
        $this->failureDetail = $failureDetail;
        return $this;
    }

    public function getLimits(): ?AppliedLimits
    {
        return $this->limits;
    }

    public function setLimits(?AppliedLimits $limits): self
    {
        $this->limits = $limits;
        return $this;
    }
}
