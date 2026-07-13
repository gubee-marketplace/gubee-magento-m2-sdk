<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Sales\Order\CardBrandEnum;
use Gubee\SDK\Enum\Sales\Order\IntegrationTypeEnum;
use Gubee\SDK\Enum\Sales\Order\PaymentIndicatorEnum;
use Gubee\SDK\Enum\Sales\Order\PaymentMethodEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class PaymentMethod extends AbstractModel
{
    protected ?string $code = null;

    protected ?string $name = null;

    protected ?PaymentIndicatorEnum $paymentIndicator = null;

    protected ?PaymentMethodEnum $paymentMethod = null;

    protected ?string $paymentDescription = null;

    protected ?float $paymentAmount = null;

    protected ?DateTimeInterface $paymentDate = null;

    protected ?IntegrationTypeEnum $integrationType = null;

    protected ?string $acquirerCnpj = null;

    protected ?CardBrandEnum $cardBrand = null;

    protected ?string $authorizationNumber = null;

    protected ?string $beneficiaryCnpj = null;

    protected ?string $paymentTerminalId = null;

    public function __construct(
        ?string $code = null,
        ?string $name = null,
        PaymentIndicatorEnum|string|null $paymentIndicator = null,
        PaymentMethodEnum|string|null $paymentMethod = null,
        ?string $paymentDescription = null,
        ?float $paymentAmount = null,
        DateTimeInterface|string|null $paymentDate = null,
        IntegrationTypeEnum|string|null $integrationType = null,
        ?string $acquirerCnpj = null,
        CardBrandEnum|string|null $cardBrand = null,
        ?string $authorizationNumber = null,
        ?string $beneficiaryCnpj = null,
        ?string $paymentTerminalId = null
    ) {
        if ($code !== null) {
            $this->setCode($code);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($paymentIndicator !== null) {
            if (is_string($paymentIndicator)) {
                $paymentIndicator = PaymentIndicatorEnum::fromValue($paymentIndicator);
            }
            $this->setPaymentIndicator($paymentIndicator);
        }
        if ($paymentMethod !== null) {
            if (is_string($paymentMethod)) {
                $paymentMethod = PaymentMethodEnum::fromValue($paymentMethod);
            }
            $this->setPaymentMethod($paymentMethod);
        }
        if ($paymentDescription !== null) {
            $this->setPaymentDescription($paymentDescription);
        }
        if ($paymentAmount !== null) {
            $this->setPaymentAmount($paymentAmount);
        }
        if ($paymentDate !== null) {
            if (! $paymentDate instanceof DateTimeInterface) {
                $paymentDate = new DateTime($paymentDate);
            }
            $this->setPaymentDate($paymentDate);
        }
        if ($integrationType !== null) {
            if (is_string($integrationType)) {
                $integrationType = IntegrationTypeEnum::fromValue($integrationType);
            }
            $this->setIntegrationType($integrationType);
        }
        if ($acquirerCnpj !== null) {
            $this->setAcquirerCnpj($acquirerCnpj);
        }
        if ($cardBrand !== null) {
            if (is_string($cardBrand)) {
                $cardBrand = CardBrandEnum::fromValue($cardBrand);
            }
            $this->setCardBrand($cardBrand);
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPaymentIndicator(): ?PaymentIndicatorEnum
    {
        return $this->paymentIndicator;
    }

    public function setPaymentIndicator(?PaymentIndicatorEnum $paymentIndicator): self
    {
        $this->paymentIndicator = $paymentIndicator;
        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethodEnum
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethodEnum $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentDescription(): ?string
    {
        return $this->paymentDescription;
    }

    public function setPaymentDescription(?string $paymentDescription): self
    {
        $this->paymentDescription = $paymentDescription;
        return $this;
    }

    public function getPaymentAmount(): ?float
    {
        return $this->paymentAmount;
    }

    public function setPaymentAmount(?float $paymentAmount): self
    {
        $this->paymentAmount = $paymentAmount;
        return $this;
    }

    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;
        return $this;
    }

    public function getIntegrationType(): ?IntegrationTypeEnum
    {
        return $this->integrationType;
    }

    public function setIntegrationType(?IntegrationTypeEnum $integrationType): self
    {
        $this->integrationType = $integrationType;
        return $this;
    }

    public function getAcquirerCnpj(): ?string
    {
        return $this->acquirerCnpj;
    }

    public function setAcquirerCnpj(?string $acquirerCnpj): self
    {
        $this->acquirerCnpj = $acquirerCnpj;
        return $this;
    }

    public function getCardBrand(): ?CardBrandEnum
    {
        return $this->cardBrand;
    }

    public function setCardBrand(?CardBrandEnum $cardBrand): self
    {
        $this->cardBrand = $cardBrand;
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
