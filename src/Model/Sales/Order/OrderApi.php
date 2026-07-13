<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\FreightTypeEnum;
use Gubee\SDK\Enum\Sales\Order\OrderTypeEnum;
use Gubee\SDK\Enum\Sales\Order\OriginDomainTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Sales\Order\Invoice;
use Gubee\SDK\Model\Sales\Order\ItemApi;
use Gubee\SDK\Model\Sales\Order\LogisticTypeApi;
use Gubee\SDK\Model\Sales\Order\MarketplaceShipmentApi;
use Gubee\SDK\Model\Sales\Order\OrderCustomerApi;
use Gubee\SDK\Model\Sales\Order\OrderProfitabilityApi;
use Gubee\SDK\Model\Sales\Order\OrderStatusApi;
use Gubee\SDK\Model\Sales\Order\PaymentApi;
use Gubee\SDK\Model\Sales\Order\Shipment;

use function is_array;
use function is_string;

class OrderApi extends AbstractModel
{
    protected string $id;

    protected ?string $plataform = null;

    protected ?string $sellerId = null;

    protected ?string $accountId = null;

    protected string $externalId;

    protected ?string $displayId = null;

    protected ?DateTimeInterface $createdDt = null;

    protected ?DateTimeInterface $lastModifiedDt = null;

    protected string $channel;

    /** @var array<OrderStatusApi> */

    protected array $statusHistory;

    protected ?OrderStatusApi $status = null;

    protected OrderTypeEnum $orderType;

    /** @var array<ItemApi> */

    protected array $items;

    protected ?OrderCustomerApi $customer = null;

    protected ?Address $billingAddress = null;

    protected ?Address $shippingAddress = null;

    protected ?string $shippingMethod = null;

    /** @var array<Invoice> */

    protected array $invoices;

    /** @var array<Shipment> */

    protected array $shipments;

    /** @var array<MarketplaceShipmentApi>|null */

    protected ?array $marketplaceShipments = null;

    /** @var array<PaymentApi> */

    protected array $payments;

    protected ?float $shippingCost = null;

    protected ?LogisticTypeApi $logisticType = null;

    protected ?float $totalInterest = null;

    protected ?float $totalCommission = null;

    protected ?float $totalDiscount = null;

    protected ?float $totalFreight = null;

    protected ?float $totalGross = null;

    protected ?float $totalNet = null;

    protected ?int $totalQuantity = null;

    protected FreightTypeEnum $freightType;

    protected ?DateTimeInterface $marketplaceEstimatedDeliveryDt = null;

    protected ?OriginDomainTypeEnum $originDomainType = null;

    protected ?array $additionalInfo = null;

    protected ?DateTimeInterface $marketplaceDeadlineShippingDt = null;

    protected ?float $marketplaceDiscount = null;

    protected ?float $shippingDiscount = null;

    protected ?float $serviceFee = null;

    /** @var array<string> */

    protected array $tags;

    protected ?float $totalCost = null;

    protected ?float $grossProfit = null;

    protected ?float $grossMargin = null;

    protected ?string $costEnrichmentStatus = null;

    protected ?OrderProfitabilityApi $profitability = null;

    /**
     * @param array<OrderStatusApi|array<mixed>> $statusHistory
     * @param OrderStatusApi|array<mixed>|null $status
     * @param array<ItemApi|array<mixed>> $items
     * @param OrderCustomerApi|array<mixed>|null $customer
     * @param Address|array<mixed>|null $billingAddress
     * @param Address|array<mixed>|null $shippingAddress
     * @param array<Invoice|array<mixed>> $invoices
     * @param array<Shipment|array<mixed>> $shipments
     * @param array<MarketplaceShipmentApi|array<mixed>>|null $marketplaceShipments
     * @param array<PaymentApi|array<mixed>> $payments
     * @param LogisticTypeApi|array<mixed>|null $logisticType
     * @param array<string> $tags
     * @param OrderProfitabilityApi|array<mixed>|null $profitability
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $id,
        ?string $plataform = null,
        ?string $sellerId = null,
        ?string $accountId = null,
        string $externalId,
        ?string $displayId = null,
        DateTimeInterface|string|null $createdDt = null,
        DateTimeInterface|string|null $lastModifiedDt = null,
        string $channel,
        array $statusHistory,
        OrderStatusApi|array|null $status = null,
        OrderTypeEnum|string $orderType,
        array $items,
        OrderCustomerApi|array|null $customer = null,
        Address|array|null $billingAddress = null,
        Address|array|null $shippingAddress = null,
        ?string $shippingMethod = null,
        array $invoices,
        array $shipments,
        ?array $marketplaceShipments = null,
        array $payments,
        ?float $shippingCost = null,
        LogisticTypeApi|array|null $logisticType = null,
        ?float $totalInterest = null,
        ?float $totalCommission = null,
        ?float $totalDiscount = null,
        ?float $totalFreight = null,
        ?float $totalGross = null,
        ?float $totalNet = null,
        ?int $totalQuantity = null,
        FreightTypeEnum|string $freightType,
        DateTimeInterface|string|null $marketplaceEstimatedDeliveryDt = null,
        OriginDomainTypeEnum|string|null $originDomainType = null,
        ?array $additionalInfo = null,
        DateTimeInterface|string|null $marketplaceDeadlineShippingDt = null,
        ?float $marketplaceDiscount = null,
        ?float $shippingDiscount = null,
        ?float $serviceFee = null,
        array $tags,
        ?float $totalCost = null,
        ?float $grossProfit = null,
        ?float $grossMargin = null,
        ?string $costEnrichmentStatus = null,
        OrderProfitabilityApi|array|null $profitability = null
    ) {
        $this->setId($id);
        if ($plataform !== null) {
            $this->setPlataform($plataform);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($accountId !== null) {
            $this->setAccountId($accountId);
        }
        $this->setExternalId($externalId);
        if ($displayId !== null) {
            $this->setDisplayId($displayId);
        }
        if ($createdDt !== null) {
            if (! $createdDt instanceof DateTimeInterface) {
                $createdDt = new DateTime($createdDt);
            }
            $this->setCreatedDt($createdDt);
        }
        if ($lastModifiedDt !== null) {
            if (! $lastModifiedDt instanceof DateTimeInterface) {
                $lastModifiedDt = new DateTime($lastModifiedDt);
            }
            $this->setLastModifiedDt($lastModifiedDt);
        }
        $this->setChannel($channel);
        foreach ($statusHistory as $key => $value) {
            if (is_array($value)) {
                $statusHistory[$key] = $serviceProvider->create(
                    OrderStatusApi::class,
                    $value
                );
            }
        }
        $this->setStatusHistory($statusHistory);
        if ($status !== null) {
            if (is_array($status)) {
                $status = $serviceProvider->create(
                    OrderStatusApi::class,
                    $status
                );
            }
            $this->setStatus($status);
        }
        if (is_string($orderType)) {
            $orderType = OrderTypeEnum::fromValue($orderType);
        }
        $this->setOrderType($orderType);
        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $items[$key] = $serviceProvider->create(
                    ItemApi::class,
                    $item
                );
            }
        }
        $this->setItems($items);
        if ($customer !== null) {
            if (is_array($customer)) {
                $customer = $serviceProvider->create(
                    OrderCustomerApi::class,
                    $customer
                );
            }
            $this->setCustomer($customer);
        }
        if ($billingAddress !== null) {
            if (is_array($billingAddress)) {
                $billingAddress = $serviceProvider->create(
                    Address::class,
                    $billingAddress
                );
            }
            $this->setBillingAddress($billingAddress);
        }
        if ($shippingAddress !== null) {
            if (is_array($shippingAddress)) {
                $shippingAddress = $serviceProvider->create(
                    Address::class,
                    $shippingAddress
                );
            }
            $this->setShippingAddress($shippingAddress);
        }
        if ($shippingMethod !== null) {
            $this->setShippingMethod($shippingMethod);
        }
        foreach ($invoices as $key => $value) {
            if (is_array($value)) {
                $invoices[$key] = $serviceProvider->create(
                    Invoice::class,
                    $value
                );
            }
        }
        $this->setInvoices($invoices);
        foreach ($shipments as $key => $value) {
            if (is_array($value)) {
                $shipments[$key] = $serviceProvider->create(
                    Shipment::class,
                    $value
                );
            }
        }
        $this->setShipments($shipments);
        if ($marketplaceShipments !== null) {
            foreach ($marketplaceShipments as $key => $value) {
                if (is_array($value)) {
                    $marketplaceShipments[$key] = $serviceProvider->create(
                        MarketplaceShipmentApi::class,
                        $value
                    );
                }
            }
            $this->setMarketplaceShipments($marketplaceShipments);
        }
        foreach ($payments as $key => $value) {
            if (is_array($value)) {
                $payments[$key] = $serviceProvider->create(
                    PaymentApi::class,
                    $value
                );
            }
        }
        $this->setPayments($payments);
        if ($shippingCost !== null) {
            $this->setShippingCost($shippingCost);
        }
        if ($logisticType !== null) {
            if (is_array($logisticType)) {
                $logisticType = $serviceProvider->create(
                    LogisticTypeApi::class,
                    $logisticType
                );
            }
            $this->setLogisticType($logisticType);
        }
        if ($totalInterest !== null) {
            $this->setTotalInterest($totalInterest);
        }
        if ($totalCommission !== null) {
            $this->setTotalCommission($totalCommission);
        }
        if ($totalDiscount !== null) {
            $this->setTotalDiscount($totalDiscount);
        }
        if ($totalFreight !== null) {
            $this->setTotalFreight($totalFreight);
        }
        if ($totalGross !== null) {
            $this->setTotalGross($totalGross);
        }
        if ($totalNet !== null) {
            $this->setTotalNet($totalNet);
        }
        if ($totalQuantity !== null) {
            $this->setTotalQuantity($totalQuantity);
        }
        if (is_string($freightType)) {
            $freightType = FreightTypeEnum::fromValue($freightType);
        }
        $this->setFreightType($freightType);
        if ($marketplaceEstimatedDeliveryDt !== null) {
            if (! $marketplaceEstimatedDeliveryDt instanceof DateTimeInterface) {
                $marketplaceEstimatedDeliveryDt = new DateTime($marketplaceEstimatedDeliveryDt);
            }
            $this->setMarketplaceEstimatedDeliveryDt($marketplaceEstimatedDeliveryDt);
        }
        if ($originDomainType !== null) {
            if (is_string($originDomainType)) {
                $originDomainType = OriginDomainTypeEnum::fromValue($originDomainType);
            }
            $this->setOriginDomainType($originDomainType);
        }
        if ($additionalInfo !== null) {
            $this->setAdditionalInfo($additionalInfo);
        }
        if ($marketplaceDeadlineShippingDt !== null) {
            if (! $marketplaceDeadlineShippingDt instanceof DateTimeInterface) {
                $marketplaceDeadlineShippingDt = new DateTime($marketplaceDeadlineShippingDt);
            }
            $this->setMarketplaceDeadlineShippingDt($marketplaceDeadlineShippingDt);
        }
        if ($marketplaceDiscount !== null) {
            $this->setMarketplaceDiscount($marketplaceDiscount);
        }
        if ($shippingDiscount !== null) {
            $this->setShippingDiscount($shippingDiscount);
        }
        if ($serviceFee !== null) {
            $this->setServiceFee($serviceFee);
        }
        $this->setTags($tags);
        if ($totalCost !== null) {
            $this->setTotalCost($totalCost);
        }
        if ($grossProfit !== null) {
            $this->setGrossProfit($grossProfit);
        }
        if ($grossMargin !== null) {
            $this->setGrossMargin($grossMargin);
        }
        if ($costEnrichmentStatus !== null) {
            $this->setCostEnrichmentStatus($costEnrichmentStatus);
        }
        if ($profitability !== null) {
            if (is_array($profitability)) {
                $profitability = $serviceProvider->create(
                    OrderProfitabilityApi::class,
                    $profitability
                );
            }
            $this->setProfitability($profitability);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPlataform(): ?string
    {
        return $this->plataform;
    }

    public function setPlataform(?string $plataform): self
    {
        $this->plataform = $plataform;
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

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function setAccountId(?string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getDisplayId(): ?string
    {
        return $this->displayId;
    }

    public function setDisplayId(?string $displayId): self
    {
        $this->displayId = $displayId;
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

    public function getLastModifiedDt(): ?DateTimeInterface
    {
        return $this->lastModifiedDt;
    }

    public function setLastModifiedDt(?DateTimeInterface $lastModifiedDt): self
    {
        $this->lastModifiedDt = $lastModifiedDt;
        return $this;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return array<OrderStatusApi>
     */
    public function getStatusHistory(): array
    {
        return $this->statusHistory;
    }

    /**
     * @param array<OrderStatusApi> $statusHistory
     */
    public function setStatusHistory(array $statusHistory): self
    {
        $this->validateArrayElements($statusHistory, OrderStatusApi::class);
        $this->statusHistory = $statusHistory;
        return $this;
    }

    public function getStatus(): ?OrderStatusApi
    {
        return $this->status;
    }

    public function setStatus(?OrderStatusApi $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getOrderType(): OrderTypeEnum
    {
        return $this->orderType;
    }

    public function setOrderType(OrderTypeEnum $orderType): self
    {
        $this->orderType = $orderType;
        return $this;
    }

    /**
     * @return array<ItemApi>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array<ItemApi> $items
     */
    public function setItems(array $items): self
    {
        $this->validateArrayElements($items, ItemApi::class);
        $this->items = $items;
        return $this;
    }

    public function getCustomer(): ?OrderCustomerApi
    {
        return $this->customer;
    }

    public function setCustomer(?OrderCustomerApi $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(?Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getShippingAddress(): ?Address
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(?Address $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(?string $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * @return array<Invoice>
     */
    public function getInvoices(): array
    {
        return $this->invoices;
    }

    /**
     * @param array<Invoice> $invoices
     */
    public function setInvoices(array $invoices): self
    {
        $this->validateArrayElements($invoices, Invoice::class);
        $this->invoices = $invoices;
        return $this;
    }

    /**
     * @return array<Shipment>
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /**
     * @param array<Shipment> $shipments
     */
    public function setShipments(array $shipments): self
    {
        $this->validateArrayElements($shipments, Shipment::class);
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @return array<MarketplaceShipmentApi>|null
     */
    public function getMarketplaceShipments(): ?array
    {
        return $this->marketplaceShipments;
    }

    /**
     * @param array<MarketplaceShipmentApi> $marketplaceShipments
     */
    public function setMarketplaceShipments(?array $marketplaceShipments): self
    {
        if ($marketplaceShipments !== null) {
            $this->validateArrayElements($marketplaceShipments, MarketplaceShipmentApi::class);
        }
        $this->marketplaceShipments = $marketplaceShipments;
        return $this;
    }

    /**
     * @return array<PaymentApi>
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param array<PaymentApi> $payments
     */
    public function setPayments(array $payments): self
    {
        $this->validateArrayElements($payments, PaymentApi::class);
        $this->payments = $payments;
        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(?float $shippingCost): self
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    public function getLogisticType(): ?LogisticTypeApi
    {
        return $this->logisticType;
    }

    public function setLogisticType(?LogisticTypeApi $logisticType): self
    {
        $this->logisticType = $logisticType;
        return $this;
    }

    public function getTotalInterest(): ?float
    {
        return $this->totalInterest;
    }

    public function setTotalInterest(?float $totalInterest): self
    {
        $this->totalInterest = $totalInterest;
        return $this;
    }

    public function getTotalCommission(): ?float
    {
        return $this->totalCommission;
    }

    public function setTotalCommission(?float $totalCommission): self
    {
        $this->totalCommission = $totalCommission;
        return $this;
    }

    public function getTotalDiscount(): ?float
    {
        return $this->totalDiscount;
    }

    public function setTotalDiscount(?float $totalDiscount): self
    {
        $this->totalDiscount = $totalDiscount;
        return $this;
    }

    public function getTotalFreight(): ?float
    {
        return $this->totalFreight;
    }

    public function setTotalFreight(?float $totalFreight): self
    {
        $this->totalFreight = $totalFreight;
        return $this;
    }

    public function getTotalGross(): ?float
    {
        return $this->totalGross;
    }

    public function setTotalGross(?float $totalGross): self
    {
        $this->totalGross = $totalGross;
        return $this;
    }

    public function getTotalNet(): ?float
    {
        return $this->totalNet;
    }

    public function setTotalNet(?float $totalNet): self
    {
        $this->totalNet = $totalNet;
        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(?int $totalQuantity): self
    {
        $this->totalQuantity = $totalQuantity;
        return $this;
    }

    public function getFreightType(): FreightTypeEnum
    {
        return $this->freightType;
    }

    public function setFreightType(FreightTypeEnum $freightType): self
    {
        $this->freightType = $freightType;
        return $this;
    }

    public function getMarketplaceEstimatedDeliveryDt(): ?DateTimeInterface
    {
        return $this->marketplaceEstimatedDeliveryDt;
    }

    public function setMarketplaceEstimatedDeliveryDt(?DateTimeInterface $marketplaceEstimatedDeliveryDt): self
    {
        $this->marketplaceEstimatedDeliveryDt = $marketplaceEstimatedDeliveryDt;
        return $this;
    }

    public function getOriginDomainType(): ?OriginDomainTypeEnum
    {
        return $this->originDomainType;
    }

    public function setOriginDomainType(?OriginDomainTypeEnum $originDomainType): self
    {
        $this->originDomainType = $originDomainType;
        return $this;
    }

    public function getAdditionalInfo(): ?array
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?array $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function getMarketplaceDeadlineShippingDt(): ?DateTimeInterface
    {
        return $this->marketplaceDeadlineShippingDt;
    }

    public function setMarketplaceDeadlineShippingDt(?DateTimeInterface $marketplaceDeadlineShippingDt): self
    {
        $this->marketplaceDeadlineShippingDt = $marketplaceDeadlineShippingDt;
        return $this;
    }

    public function getMarketplaceDiscount(): ?float
    {
        return $this->marketplaceDiscount;
    }

    public function setMarketplaceDiscount(?float $marketplaceDiscount): self
    {
        $this->marketplaceDiscount = $marketplaceDiscount;
        return $this;
    }

    public function getShippingDiscount(): ?float
    {
        return $this->shippingDiscount;
    }

    public function setShippingDiscount(?float $shippingDiscount): self
    {
        $this->shippingDiscount = $shippingDiscount;
        return $this;
    }

    public function getServiceFee(): ?float
    {
        return $this->serviceFee;
    }

    public function setServiceFee(?float $serviceFee): self
    {
        $this->serviceFee = $serviceFee;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array<string> $tags
     */
    public function setTags(array $tags): self
    {
        $this->validateArrayElements($tags, 'string');
        $this->tags = $tags;
        return $this;
    }

    public function getTotalCost(): ?float
    {
        return $this->totalCost;
    }

    public function setTotalCost(?float $totalCost): self
    {
        $this->totalCost = $totalCost;
        return $this;
    }

    public function getGrossProfit(): ?float
    {
        return $this->grossProfit;
    }

    public function setGrossProfit(?float $grossProfit): self
    {
        $this->grossProfit = $grossProfit;
        return $this;
    }

    public function getGrossMargin(): ?float
    {
        return $this->grossMargin;
    }

    public function setGrossMargin(?float $grossMargin): self
    {
        $this->grossMargin = $grossMargin;
        return $this;
    }

    public function getCostEnrichmentStatus(): ?string
    {
        return $this->costEnrichmentStatus;
    }

    public function setCostEnrichmentStatus(?string $costEnrichmentStatus): self
    {
        $this->costEnrichmentStatus = $costEnrichmentStatus;
        return $this;
    }

    public function getProfitability(): ?OrderProfitabilityApi
    {
        return $this->profitability;
    }

    public function setProfitability(?OrderProfitabilityApi $profitability): self
    {
        $this->profitability = $profitability;
        return $this;
    }
}
