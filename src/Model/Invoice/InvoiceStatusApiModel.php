<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class InvoiceStatusApiModel extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $invoiceId = null;

    protected ?string $invoiceExternalId = null;

    protected ?string $status = null;

    protected DateTimeInterface $createdDate;

    /** @var array<string>|null */

    protected ?array $messages = null;

    /**
     * @param string|DateTimeInterface $createdDate
     * @param array<string>|null $messages
     */
    public function __construct(
        ?string $id = null,
        ?string $invoiceId = null,
        ?string $invoiceExternalId = null,
        ?string $status = null,
        $createdDate,
        ?array $messages = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($invoiceId !== null) {
            $this->setInvoiceId($invoiceId);
        }
        if ($invoiceExternalId !== null) {
            $this->setInvoiceExternalId($invoiceExternalId);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        if (! $createdDate instanceof DateTimeInterface) {
            $createdDate = new DateTime($createdDate);
        }
        $this->setCreatedDate($createdDate);
        if ($messages !== null) {
            $this->setMessages($messages);
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

    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(?string $invoiceId): self
    {
        $this->invoiceId = $invoiceId;
        return $this;
    }

    public function getInvoiceExternalId(): ?string
    {
        return $this->invoiceExternalId;
    }

    public function setInvoiceExternalId(?string $invoiceExternalId): self
    {
        $this->invoiceExternalId = $invoiceExternalId;
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

    public function getCreatedDate(): DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getMessages(): ?array
    {
        return $this->messages;
    }

    /**
     * @param array<string> $messages
     */
    public function setMessages(?array $messages): self
    {
        if ($messages !== null) {
            $this->validateArrayElements($messages, 'string');
        }
        $this->messages = $messages;
        return $this;
    }
}
