<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\Invoice;

use function is_array;

class FindInvoice extends AbstractModel
{
    /** @var array<Invoice>|null */

    protected ?array $invoices = null;

    protected ?int $total = null;

    /**
     * @param array<Invoice|array<mixed>>|null $invoices
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?array $invoices = null,
        ?int $total = null
    ) {
        if ($invoices !== null) {
            foreach ($invoices as $key => $value) {
                if (is_array($value)) {
                    $invoices[$key] = $serviceProvider->create(
                        Invoice::class,
                        $value
                    );
                }
            }
            $this->setInvoices($invoices);
        }
        if ($total !== null) {
            $this->setTotal($total);
        }
    }

    /**
     * @return array<Invoice>|null
     */
    public function getInvoices(): ?array
    {
        return $this->invoices;
    }

    /**
     * @param array<Invoice> $invoices
     */
    public function setInvoices(?array $invoices): self
    {
        if ($invoices !== null) {
            $this->validateArrayElements($invoices, Invoice::class);
        }
        $this->invoices = $invoices;
        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;
        return $this;
    }
}
