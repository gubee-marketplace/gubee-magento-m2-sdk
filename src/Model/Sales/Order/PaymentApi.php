<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Invoice\RegistrationNumberApi;
use Gubee\SDK\Model\Sales\Order\CreditCardNetworkApi;
use Gubee\SDK\Model\Sales\Order\PaymentMethod;

use function is_array;

class PaymentApi extends AbstractModel
{
    protected ?string $method = null;

    protected ?string $description = null;

    protected ?int $parcels = null;

    protected ?float $value = null;

    protected ?DateTimeInterface $paymentDt = null;

    protected ?RegistrationNumberApi $intermediary = null;

    protected ?RegistrationNumberApi $acquirer = null;

    protected ?CreditCardNetworkApi $creditCardNetwork = null;

    protected ?PaymentMethod $paymentMethod = null;

    protected ?string $integrationType = null;

    protected ?string $authorizationNumber = null;

    protected ?string $beneficiaryCnpj = null;

    protected ?string $paymentTerminalId = null;

    /**
     * @param RegistrationNumberApi|array<mixed>|null $intermediary
     * @param RegistrationNumberApi|array<mixed>|null $acquirer
     * @param CreditCardNetworkApi|array<mixed>|null $creditCardNetwork
     * @param PaymentMethod|array<mixed>|null $paymentMethod
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $method = null,
        ?string $description = null,
        ?int $parcels = null,
        ?float $value = null,
        DateTimeInterface|string|null $paymentDt = null,
        RegistrationNumberApi|array|null $intermediary = null,
        RegistrationNumberApi|array|null $acquirer = null,
        CreditCardNetworkApi|array|null $creditCardNetwork = null,
        PaymentMethod|array|null $paymentMethod = null,
        ?string $integrationType = null,
        ?string $authorizationNumber = null,
        ?string $beneficiaryCnpj = null,
        ?string $paymentTerminalId = null
    ) {
        if ($method !== null) {
            $this->setMethod($method);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($parcels !== null) {
            $this->setParcels($parcels);
        }
        if ($value !== null) {
            $this->setValue($value);
        }
        if ($paymentDt !== null) {
            if (! $paymentDt instanceof DateTimeInterface) {
                $paymentDt = new DateTime($paymentDt);
            }
            $this->setPaymentDt($paymentDt);
        }
        if ($intermediary !== null) {
            if (is_array($intermediary)) {
                $intermediary = $serviceProvider->create(
                    RegistrationNumberApi::class,
                    $intermediary
                );
            }
            $this->setIntermediary($intermediary);
        }
        if ($acquirer !== null) {
            if (is_array($acquirer)) {
                $acquirer = $serviceProvider->create(
                    RegistrationNumberApi::class,
                    $acquirer
                );
            }
            $this->setAcquirer($acquirer);
        }
        if ($creditCardNetwork !== null) {
            if (is_array($creditCardNetwork)) {
                $creditCardNetwork = $serviceProvider->create(
                    CreditCardNetworkApi::class,
                    $creditCardNetwork
                );
            }
            $this->setCreditCardNetwork($creditCardNetwork);
        }
        if ($paymentMethod !== null) {
            if (is_array($paymentMethod)) {
                $paymentMethod = $serviceProvider->create(
                    PaymentMethod::class,
                    $paymentMethod
                );
            }
            $this->setPaymentMethod($paymentMethod);
        }
        if ($integrationType !== null) {
            $this->setIntegrationType($integrationType);
        }
        if ($authorizationNumber !== null) {
            $this->setAuthorizationNumber($authorizationNumber);
        }
        if ($beneficiaryCnpj !== null) {
            $this->setBeneficiaryCnpj($beneficiaryCnpj);
        }
        if ($paymentTerminalId !== null) {
            $this->setPaymentTerminalId($paymentTerminalId);
        }
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(?string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getParcels(): ?int
    {
        return $this->parcels;
    }

    public function setParcels(?int $parcels): self
    {
        $this->parcels = $parcels;
        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getPaymentDt(): ?DateTimeInterface
    {
        return $this->paymentDt;
    }

    public function setPaymentDt(?DateTimeInterface $paymentDt): self
    {
        $this->paymentDt = $paymentDt;
        return $this;
    }

    public function getIntermediary(): ?RegistrationNumberApi
    {
        return $this->intermediary;
    }

    public function setIntermediary(?RegistrationNumberApi $intermediary): self
    {
        $this->intermediary = $intermediary;
        return $this;
    }

    public function getAcquirer(): ?RegistrationNumberApi
    {
        return $this->acquirer;
    }

    public function setAcquirer(?RegistrationNumberApi $acquirer): self
    {
        $this->acquirer = $acquirer;
        return $this;
    }

    public function getCreditCardNetwork(): ?CreditCardNetworkApi
    {
        return $this->creditCardNetwork;
    }

    public function setCreditCardNetwork(?CreditCardNetworkApi $creditCardNetwork): self
    {
        $this->creditCardNetwork = $creditCardNetwork;
        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getIntegrationType(): ?string
    {
        return $this->integrationType;
    }

    public function setIntegrationType(?string $integrationType): self
    {
        $this->integrationType = $integrationType;
        return $this;
    }

    public function getAuthorizationNumber(): ?string
    {
        return $this->authorizationNumber;
    }

    public function setAuthorizationNumber(?string $authorizationNumber): self
    {
        $this->authorizationNumber = $authorizationNumber;
        return $this;
    }

    public function getBeneficiaryCnpj(): ?string
    {
        return $this->beneficiaryCnpj;
    }

    public function setBeneficiaryCnpj(?string $beneficiaryCnpj): self
    {
        $this->beneficiaryCnpj = $beneficiaryCnpj;
        return $this;
    }

    public function getPaymentTerminalId(): ?string
    {
        return $this->paymentTerminalId;
    }

    public function setPaymentTerminalId(?string $paymentTerminalId): self
    {
        $this->paymentTerminalId = $paymentTerminalId;
        return $this;
    }
}
