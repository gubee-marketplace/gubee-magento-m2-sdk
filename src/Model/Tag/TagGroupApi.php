<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Tag;

use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class TagGroupApi extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $accountId = null;

    protected ?DateTimeInterface $createdDt = null;

    /** @var array<string> */

    protected array $ordersGroup;

    protected ?string $errorMessage = null;

    protected ?string $status = null;

    /** @var array<string>|null */

    protected ?array $packageType = null;

    protected ?string $pdfLink = null;

    protected ?string $zplLink = null;

    /**
     * @param string|DateTimeInterface|null $createdDt
     * @param array<string> $ordersGroup
     * @param array<string>|null $packageType
     */
    public function __construct(
        ?string $id = null,
        ?string $accountId = null,
        ?DateTimeInterface $createdDt = null,
        array $ordersGroup,
        ?string $errorMessage = null,
        ?string $status = null,
        ?array $packageType = null,
        ?string $pdfLink = null,
        ?string $zplLink = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($accountId !== null) {
            $this->setAccountId($accountId);
        }
        if ($createdDt !== null) {
            $this->setCreatedDt($createdDt);
        }
        $this->setOrdersGroup($ordersGroup);
        if ($errorMessage !== null) {
            $this->setErrorMessage($errorMessage);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        if ($packageType !== null) {
            $this->setPackageType($packageType);
        }
        if ($pdfLink !== null) {
            $this->setPdfLink($pdfLink);
        }
        if ($zplLink !== null) {
            $this->setZplLink($zplLink);
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

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function setAccountId(?string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    public function getCreatedDt(): ?DateTimeInterface
    {
        return $this->createdDt;
    }

    public function setCreatedDt(?DateTimeInterface $createdDt): self
    {
        $this->createdDt = $createdDt;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getOrdersGroup(): array
    {
        return $this->ordersGroup;
    }

    /**
     * @param array<string> $ordersGroup
     */
    public function setOrdersGroup(array $ordersGroup): self
    {
        $this->validateArrayElements($ordersGroup, 'string');
        $this->ordersGroup = $ordersGroup;
        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;
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

    /**
     * @return array<string>|null
     */
    public function getPackageType(): ?array
    {
        return $this->packageType;
    }

    /**
     * @param array<string> $packageType
     */
    public function setPackageType(?array $packageType): self
    {
        if ($packageType !== null) {
            $this->validateArrayElements($packageType, 'string');
        }
        $this->packageType = $packageType;
        return $this;
    }

    public function getPdfLink(): ?string
    {
        return $this->pdfLink;
    }

    public function setPdfLink(?string $pdfLink): self
    {
        $this->pdfLink = $pdfLink;
        return $this;
    }

    public function getZplLink(): ?string
    {
        return $this->zplLink;
    }

    public function setZplLink(?string $zplLink): self
    {
        $this->zplLink = $zplLink;
        return $this;
    }
}
