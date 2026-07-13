<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoicer;

use Gubee\SDK\Enum\Sales\Order\PurposeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class ReversalInvoice extends AbstractModel
{
    protected ?string $invoiceId = null;

    protected ?string $reason = null;

    protected ?PurposeEnum $purpose = null;

    public function __construct(
        ?string $invoiceId = null,
        ?string $reason = null,
        PurposeEnum|string|null $purpose = null
    ) {
        if ($invoiceId !== null) {
            $this->setInvoiceId($invoiceId);
        }
        if ($reason !== null) {
            $this->setReason($reason);
        }
        if ($purpose !== null) {
            if (is_string($purpose)) {
                $purpose = PurposeEnum::fromValue($purpose);
            }
            $this->setPurpose($purpose);
        }
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

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    public function getPurpose(): ?PurposeEnum
    {
        return $this->purpose;
    }

    public function setPurpose(?PurposeEnum $purpose): self
    {
        $this->purpose = $purpose;
        return $this;
    }
}
