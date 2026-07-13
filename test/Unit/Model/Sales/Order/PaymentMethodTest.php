<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Sales\Order\CardBrandEnum;
use Gubee\SDK\Enum\Sales\Order\IntegrationTypeEnum;
use Gubee\SDK\Enum\Sales\Order\PaymentIndicatorEnum;
use Gubee\SDK\Enum\Sales\Order\PaymentMethodEnum;
use Gubee\SDK\Model\Sales\Order\PaymentMethod;
use PHPUnit\Framework\TestCase;

class PaymentMethodTest extends TestCase
{
    private function build(): PaymentMethod
    {
        return new PaymentMethod(
            'code-1',
            'name-1',
            'CASH',
            'CASH',
            'desc',
            10.5,
            '2026-01-01',
            'INTEGRATED',
            '11111111000191',
            'VISA',
            'auth-1',
            '22222222000191',
            'terminal-1'
        );
    }

    public function testConstructorCoercesEnumsAndDate(): void
    {
        $method = $this->build();

        $this->assertSame('code-1', $method->getCode());
        $this->assertSame('name-1', $method->getName());
        $this->assertEquals(PaymentIndicatorEnum::CASH(), $method->getPaymentIndicator());
        $this->assertEquals(PaymentMethodEnum::fromValue('CASH'), $method->getPaymentMethod());
        $this->assertSame('desc', $method->getPaymentDescription());
        $this->assertSame(10.5, $method->getPaymentAmount());
        $this->assertInstanceOf(DateTimeInterface::class, $method->getPaymentDate());
        $this->assertSame('2026-01-01', $method->getPaymentDate()->format('Y-m-d'));
        $this->assertEquals(IntegrationTypeEnum::fromValue('INTEGRATED'), $method->getIntegrationType());
        $this->assertSame('11111111000191', $method->getAcquirerCnpj());
        $this->assertEquals(CardBrandEnum::fromValue('VISA'), $method->getCardBrand());
        $this->assertSame('auth-1', $method->getAuthorizationNumber());
        $this->assertSame('22222222000191', $method->getBeneficiaryCnpj());
        $this->assertSame('terminal-1', $method->getPaymentTerminalId());
    }

    public function testConstructorAcceptsEnumInstancesAndDateTime(): void
    {
        $date = new DateTime('2027-02-02');

        $method = new PaymentMethod(
            'code',
            'name',
            PaymentIndicatorEnum::CASH(),
            PaymentMethodEnum::fromValue('CASH'),
            'desc',
            1.0,
            $date,
            IntegrationTypeEnum::fromValue('INTEGRATED'),
            'acq',
            CardBrandEnum::fromValue('VISA'),
            'auth',
            'ben',
            'term'
        );

        $this->assertSame($date, $method->getPaymentDate());
    }

    public function testSetters(): void
    {
        $method = $this->build();

        $method->setCode('code-2');
        $method->setName('name-2');
        $method->setPaymentIndicator(PaymentIndicatorEnum::INSTALLMENT());
        $method->setPaymentMethod(PaymentMethodEnum::fromValue('CASH'));
        $method->setPaymentDescription('desc-2');
        $method->setPaymentAmount(20.0);
        $newDate = new DateTime('2028-01-01');
        $method->setPaymentDate($newDate);
        $method->setIntegrationType(IntegrationTypeEnum::fromValue('INTEGRATED'));
        $method->setAcquirerCnpj('cnpj-2');
        $method->setCardBrand(CardBrandEnum::fromValue('VISA'));
        $method->setAuthorizationNumber('auth-2');
        $method->setBeneficiaryCnpj('ben-2');
        $method->setPaymentTerminalId('term-2');

        $this->assertSame('code-2', $method->getCode());
        $this->assertSame('name-2', $method->getName());
        $this->assertEquals(PaymentIndicatorEnum::INSTALLMENT(), $method->getPaymentIndicator());
        $this->assertSame('desc-2', $method->getPaymentDescription());
        $this->assertSame(20.0, $method->getPaymentAmount());
        $this->assertSame($newDate, $method->getPaymentDate());
        $this->assertSame('cnpj-2', $method->getAcquirerCnpj());
        $this->assertSame('auth-2', $method->getAuthorizationNumber());
        $this->assertSame('ben-2', $method->getBeneficiaryCnpj());
        $this->assertSame('term-2', $method->getPaymentTerminalId());
    }
}
