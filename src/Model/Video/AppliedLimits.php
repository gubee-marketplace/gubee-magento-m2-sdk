<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Video;

use Gubee\SDK\Model\AbstractModel;

class AppliedLimits extends AbstractModel
{
    protected ?int $maxSizeBytes = null;

    protected ?int $maxDurationMs = null;

    protected ?int $minWidth = null;

    protected ?int $minHeight = null;

    public function __construct(
        ?int $maxSizeBytes = null,
        ?int $maxDurationMs = null,
        ?int $minWidth = null,
        ?int $minHeight = null
    ) {
        if ($maxSizeBytes !== null) {
            $this->setMaxSizeBytes($maxSizeBytes);
        }
        if ($maxDurationMs !== null) {
            $this->setMaxDurationMs($maxDurationMs);
        }
        if ($minWidth !== null) {
            $this->setMinWidth($minWidth);
        }
        if ($minHeight !== null) {
            $this->setMinHeight($minHeight);
        }
    }

    public function getMaxSizeBytes(): ?int
    {
        return $this->maxSizeBytes;
    }

    public function setMaxSizeBytes(?int $maxSizeBytes): self
    {
        $this->maxSizeBytes = $maxSizeBytes;
        return $this;
    }

    public function getMaxDurationMs(): ?int
    {
        return $this->maxDurationMs;
    }

    public function setMaxDurationMs(?int $maxDurationMs): self
    {
        $this->maxDurationMs = $maxDurationMs;
        return $this;
    }

    public function getMinWidth(): ?int
    {
        return $this->minWidth;
    }

    public function setMinWidth(?int $minWidth): self
    {
        $this->minWidth = $minWidth;
        return $this;
    }

    public function getMinHeight(): ?int
    {
        return $this->minHeight;
    }

    public function setMinHeight(?int $minHeight): self
    {
        $this->minHeight = $minHeight;
        return $this;
    }
}
