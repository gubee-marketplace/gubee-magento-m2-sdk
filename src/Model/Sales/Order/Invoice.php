<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\AmbientEnum;
use Gubee\SDK\Enum\Sales\Order\BuyerPresenceEnum;
use Gubee\SDK\Enum\Sales\Order\PurposeEnum;
use Gubee\SDK\Enum\Sales\Order\StatusEnum;
use Gubee\SDK\Enum\Sales\Order\TypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Invoice\InvoiceItem;
use Gubee\SDK\Model\Invoice\ISSQNCalculation;
use Gubee\SDK\Model\Invoice\Issuer;
use Gubee\SDK\Model\Sales\Order\Carrier;
use Gubee\SDK\Model\Sales\Order\Customer;
use Gubee\SDK\Model\Sales\Order\PaymentMethod;

use function is_array;
use function is_string;

class Invoice extends AbstractModel
{
    protected string $line;

    protected DateTimeInterface $issueDate;

    protected ?string $danfeXml = null;

    protected ?string $danfeLink = null;

    protected string $key;

    protected string $number;

    protected ?string $id = null;

    protected ?string $sellerId = null;

    protected ?string $storeId = null;

    protected ?string $operationType = null;

    protected ?StatusEnum $status = null;

    protected ?TypeEnum $type = null;

    protected ?Issuer $issuer = null;

    protected ?int $series = null;

    protected ?PurposeEnum $purpose = null;

    protected ?string $orderId = null;

    protected ?bool $finalConsumer = null;

    protected ?BuyerPresenceEnum $buyerPresence = null;

    protected ?string $externalId = null;

    protected ?bool $reversed = null;

    protected ?Customer $customer = null;

    /** @var array<InvoiceItem>|null */

    protected ?array $items = null;

    protected ?string $additionalData = null;

    protected ?ISSQNCalculation $issQNCalculation = null;

    protected ?DateTimeInterface $createdDt = null;

    protected ?string $correctionLetterXmlLink = null;

    protected ?string $correctionLetterPdfLink = null;

    protected ?Carrier $carrier = null;

    protected ?AmbientEnum $ambient = null;

    /** @var array<PaymentMethod>|null */

    protected ?array $paymentMethods = null;

    protected ?string $creditInvoiceType = null;

    protected ?string $debitInvoiceType = null;

    protected ?string $intermediateCNPJ = null;

    protected ?string $intermediateId = null;

    protected ?float $totalProductsValue = null;

    protected ?float $totalNfValue = null;

    /**
     * @param Issuer|array<mixed>|null $issuer
     * @param Customer|array<mixed>|null $customer
     * @param array<InvoiceItem|array<mixed>>|null $items
     * @param ISSQNCalculation|array<mixed>|null $issQNCalculation
     * @param Carrier|array<mixed>|null $carrier
     * @param array<PaymentMethod|array<mixed>>|null $paymentMethods
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $line,
        DateTimeInterface|string $issueDate,
        ?string $danfeXml = null,
        ?string $danfeLink = null,
        string $key,
        string $number,
        ?string $id = null,
        ?string $sellerId = null,
        ?string $storeId = null,
        ?string $operationType = null,
        StatusEnum|string|null $status = null,
        TypeEnum|string|null $type = null,
        Issuer|array|null $issuer = null,
        ?int $series = null,
        PurposeEnum|string|null $purpose = null,
        ?string $orderId = null,
        ?bool $finalConsumer = null,
        BuyerPresenceEnum|string|null $buyerPresence = null,
        ?string $externalId = null,
        ?bool $reversed = null,
        Customer|array|null $customer = null,
        ?array $items = null,
        ?string $additionalData = null,
        ISSQNCalculation|array|null $issQNCalculation = null,
        DateTimeInterface|string|null $createdDt = null,
        ?string $correctionLetterXmlLink = null,
        ?string $correctionLetterPdfLink = null,
        Carrier|array|null $carrier = null,
        AmbientEnum|string|null $ambient = null,
        ?array $paymentMethods = null,
        ?string $creditInvoiceType = null,
        ?string $debitInvoiceType = null,
        ?string $intermediateCNPJ = null,
        ?string $intermediateId = null,
        ?float $totalProductsValue = null,
        ?float $totalNfValue = null
    ) {
        $this->setLine($line);
        if (! $issueDate instanceof DateTimeInterface) {
            $issueDate = new DateTime($issueDate);
        }
        $this->setIssueDate($issueDate);
        if ($danfeXml !== null) {
            $this->setDanfeXml($danfeXml);
        }
        if ($danfeLink !== null) {
            $this->setDanfeLink($danfeLink);
        }
        $this->setKey($key);
        $this->setNumber($number);
        if ($id !== null) {
            $this->setId($id);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($storeId !== null) {
            $this->setStoreId($storeId);
        }
        if ($operationType !== null) {
            $this->setOperationType($operationType);
        }
        if ($status !== null) {
            if (is_string($status)) {
                $status = StatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }
        if ($type !== null) {
            if (is_string($type)) {
                $type = TypeEnum::fromValue($type);
            }
            $this->setType($type);
        }
        if ($issuer !== null) {
            if (is_array($issuer)) {
                $issuer = $serviceProvider->create(
                    Issuer::class,
                    $issuer
                );
            }
            $this->setIssuer($issuer);
        }
        if ($series !== null) {
            $this->setSeries($series);
        }
        if ($purpose !== null) {
            if (is_string($purpose)) {
                $purpose = PurposeEnum::fromValue($purpose);
            }
            $this->setPurpose($purpose);
        }
        if ($orderId !== null) {
            $this->setOrderId($orderId);
        }
        if ($finalConsumer !== null) {
            $this->setFinalConsumer($finalConsumer);
        }
        if ($buyerPresence !== null) {
            if (is_string($buyerPresence)) {
                $buyerPresence = BuyerPresenceEnum::fromValue($buyerPresence);
            }
            $this->setBuyerPresence($buyerPresence);
        }
        if ($externalId !== null) {
            $this->setExternalId($externalId);
        }
        if ($reversed !== null) {
            $this->setReversed($reversed);
        }
        if ($customer !== null) {
            if (is_array($customer)) {
                $customer = $serviceProvider->create(
                    Customer::class,
                    $customer
                );
            }
            $this->setCustomer($customer);
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
        if ($additionalData !== null) {
            $this->setAdditionalData($additionalData);
        }
        if ($issQNCalculation !== null) {
            if (is_array($issQNCalculation)) {
                $issQNCalculation = $serviceProvider->create(
                    ISSQNCalculation::class,
                    $issQNCalculation
                );
            }
            $this->setIssQNCalculation($issQNCalculation);
        }
        if ($createdDt !== null) {
            if (! $createdDt instanceof DateTimeInterface) {
                $createdDt = new DateTime($createdDt);
            }
            $this->setCreatedDt($createdDt);
        }
        if ($correctionLetterXmlLink !== null) {
            $this->setCorrectionLetterXmlLink($correctionLetterXmlLink);
        }
        if ($correctionLetterPdfLink !== null) {
            $this->setCorrectionLetterPdfLink($correctionLetterPdfLink);
        }
        if ($carrier !== null) {
            if (is_array($carrier)) {
                $carrier = $serviceProvider->create(
                    Carrier::class,
                    $carrier
                );
            }
            $this->setCarrier($carrier);
        }
        if ($ambient !== null) {
            if (is_string($ambient)) {
                $ambient = AmbientEnum::fromValue($ambient);
            }
            $this->setAmbient($ambient);
        }
        if ($paymentMethods !== null) {
            foreach ($paymentMethods as $key => $value) {
                if (is_array($value)) {
                    $paymentMethods[$key] = $serviceProvider->create(
                        PaymentMethod::class,
                        $value
                    );
                }
            }
            $this->setPaymentMethods($paymentMethods);
        }
        if ($creditInvoiceType !== null) {
            $this->setCreditInvoiceType($creditInvoiceType);
        }
        if ($debitInvoiceType !== null) {
            $this->setDebitInvoiceType($debitInvoiceType);
        }
        if ($intermediateCNPJ !== null) {
            $this->setIntermediateCNPJ($intermediateCNPJ);
        }
        if ($intermediateId !== null) {
            $this->setIntermediateId($intermediateId);
        }
        if ($totalProductsValue !== null) {
            $this->setTotalProductsValue($totalProductsValue);
        }
        if ($totalNfValue !== null) {
            $this->setTotalNfValue($totalNfValue);
        }
    }

    public function getLine(): string
    {
        return $this->line;
    }

    public function setLine(string $line): self
    {
        $this->line = $line;
        return $this;
    }

    public function getIssueDate(): DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate(DateTimeInterface $issueDate): self
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    public function getDanfeXml(): ?string
    {
        return $this->danfeXml;
    }

    public function setDanfeXml(?string $danfeXml): self
    {
        $this->danfeXml = $danfeXml;
        return $this;
    }

    public function getDanfeLink(): ?string
    {
        return $this->danfeLink;
    }

    public function setDanfeLink(?string $danfeLink): self
    {
        $this->danfeLink = $danfeLink;
        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
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

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    public function setStoreId(?string $storeId): self
    {
        $this->storeId = $storeId;
        return $this;
    }

    public function getOperationType(): ?string
    {
        return $this->operationType;
    }

    public function setOperationType(?string $operationType): self
    {
        $this->operationType = $operationType;
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

    public function getType(): ?TypeEnum
    {
        return $this->type;
    }

    public function setType(?TypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getIssuer(): ?Issuer
    {
        return $this->issuer;
    }

    public function setIssuer(?Issuer $issuer): self
    {
        $this->issuer = $issuer;
        return $this;
    }

    public function getSeries(): ?int
    {
        return $this->series;
    }

    public function setSeries(?int $series): self
    {
        $this->series = $series;
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

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(?string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getFinalConsumer(): ?bool
    {
        return $this->finalConsumer;
    }

    public function setFinalConsumer(?bool $finalConsumer): self
    {
        $this->finalConsumer = $finalConsumer;
        return $this;
    }

    public function getBuyerPresence(): ?BuyerPresenceEnum
    {
        return $this->buyerPresence;
    }

    public function setBuyerPresence(?BuyerPresenceEnum $buyerPresence): self
    {
        $this->buyerPresence = $buyerPresence;
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

    public function getReversed(): ?bool
    {
        return $this->reversed;
    }

    public function setReversed(?bool $reversed): self
    {
        $this->reversed = $reversed;
        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;
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

    public function getAdditionalData(): ?string
    {
        return $this->additionalData;
    }

    public function setAdditionalData(?string $additionalData): self
    {
        $this->additionalData = $additionalData;
        return $this;
    }

    public function getIssQNCalculation(): ?ISSQNCalculation
    {
        return $this->issQNCalculation;
    }

    public function setIssQNCalculation(?ISSQNCalculation $issQNCalculation): self
    {
        $this->issQNCalculation = $issQNCalculation;
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

    public function getCorrectionLetterXmlLink(): ?string
    {
        return $this->correctionLetterXmlLink;
    }

    public function setCorrectionLetterXmlLink(?string $correctionLetterXmlLink): self
    {
        $this->correctionLetterXmlLink = $correctionLetterXmlLink;
        return $this;
    }

    public function getCorrectionLetterPdfLink(): ?string
    {
        return $this->correctionLetterPdfLink;
    }

    public function setCorrectionLetterPdfLink(?string $correctionLetterPdfLink): self
    {
        $this->correctionLetterPdfLink = $correctionLetterPdfLink;
        return $this;
    }

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(?Carrier $carrier): self
    {
        $this->carrier = $carrier;
        return $this;
    }

    public function getAmbient(): ?AmbientEnum
    {
        return $this->ambient;
    }

    public function setAmbient(?AmbientEnum $ambient): self
    {
        $this->ambient = $ambient;
        return $this;
    }

    /**
     * @return array<PaymentMethod>|null
     */
    public function getPaymentMethods(): ?array
    {
        return $this->paymentMethods;
    }

    /**
     * @param array<PaymentMethod> $paymentMethods
     */
    public function setPaymentMethods(?array $paymentMethods): self
    {
        if ($paymentMethods !== null) {
            $this->validateArrayElements($paymentMethods, PaymentMethod::class);
        }
        $this->paymentMethods = $paymentMethods;
        return $this;
    }

    public function getCreditInvoiceType(): ?string
    {
        return $this->creditInvoiceType;
    }

    public function setCreditInvoiceType(?string $creditInvoiceType): self
    {
        $this->creditInvoiceType = $creditInvoiceType;
        return $this;
    }

    public function getDebitInvoiceType(): ?string
    {
        return $this->debitInvoiceType;
    }

    public function setDebitInvoiceType(?string $debitInvoiceType): self
    {
        $this->debitInvoiceType = $debitInvoiceType;
        return $this;
    }

    public function getIntermediateCNPJ(): ?string
    {
        return $this->intermediateCNPJ;
    }

    public function setIntermediateCNPJ(?string $intermediateCNPJ): self
    {
        $this->intermediateCNPJ = $intermediateCNPJ;
        return $this;
    }

    public function getIntermediateId(): ?string
    {
        return $this->intermediateId;
    }

    public function setIntermediateId(?string $intermediateId): self
    {
        $this->intermediateId = $intermediateId;
        return $this;
    }

    public function getTotalProductsValue(): ?float
    {
        return $this->totalProductsValue;
    }

    public function setTotalProductsValue(?float $totalProductsValue): self
    {
        $this->totalProductsValue = $totalProductsValue;
        return $this;
    }

    public function getTotalNfValue(): ?float
    {
        return $this->totalNfValue;
    }

    public function setTotalNfValue(?float $totalNfValue): self
    {
        $this->totalNfValue = $totalNfValue;
        return $this;
    }
}
