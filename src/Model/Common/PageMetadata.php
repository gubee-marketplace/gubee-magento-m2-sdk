<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class PageMetadata extends AbstractModel
{
    protected ?int $size = null;

    protected ?int $totalElements = null;

    protected ?int $totalPages = null;

    protected ?int $number = null;

    public function __construct(
        ?int $size = null,
        ?int $totalElements = null,
        ?int $totalPages = null,
        ?int $number = null
    ) {
        if ($size !== null) {
            $this->setSize($size);
        }
        if ($totalElements !== null) {
            $this->setTotalElements($totalElements);
        }
        if ($totalPages !== null) {
            $this->setTotalPages($totalPages);
        }
        if ($number !== null) {
            $this->setNumber($number);
        }
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function getTotalElements(): ?int
    {
        return $this->totalElements;
    }

    public function setTotalElements(?int $totalElements): self
    {
        $this->totalElements = $totalElements;
        return $this;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(?int $totalPages): self
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;
        return $this;
    }
}
