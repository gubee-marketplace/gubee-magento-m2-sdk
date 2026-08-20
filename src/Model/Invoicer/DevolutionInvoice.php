<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoicer;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Invoice\InvoiceItem;

use function is_array;

class DevolutionInvoice extends AbstractModel
{
    protected ?string $invoiceId = null;

    /** @var array<InvoiceItem>|null */

    protected ?array $items = null;

    /**
     * @param array<InvoiceItem|array<mixed>>|null $items
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $invoiceId = null,
        ?array $items = null
    ) {
        if ($invoiceId !== null) {
            $this->setInvoiceId($invoiceId);
        }
        if ($items !== null) {
            foreach ($items as $key => $item) {
                if (is_array($item)) {
                    $items[$key] = $serviceProvider->create(
                        InvoiceItem::class,
                        $item
                    );
                }
            }
            $this->setItems($items);
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

    /**
     * @return array<InvoiceItem>|null
     */
    public function getItems(): ?array
    {
        return $this->items;
    }

    /**
     * @param array<InvoiceItem> $items
     */
    public function setItems(?array $items): self
    {
        if ($items !== null) {
            $this->validateArrayElements($items, InvoiceItem::class);
        }
        $this->items = $items;
        return $this;
    }
}
