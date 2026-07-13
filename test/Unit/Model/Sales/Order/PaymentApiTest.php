<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\RegistrationNumberApi;
use Gubee\SDK\Model\Sales\Order\CreditCardNetworkApi;
use Gubee\SDK\Model\Sales\Order\PaymentApi;
use Gubee\SDK\Model\Sales\Order\PaymentMethod;
use PHPUnit\Framework\TestCase;

class PaymentApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): PaymentApi
    {
        return $this->serviceProvider()->create(
            PaymentApi::class,
            $overrides + [
                'method'              => 'credit_card',
                'description'         => 'desc',
                'parcels'             => 3,
                'value'               => 100.0,
                'paymentDt'           => '2026-01-01',
                'intermediary'        => ['name' => 'Interm', 'registrationNumber' => '111'],
                'acquirer'            => ['name' => 'Acquirer', 'registrationNumber' => '222'],
                'creditCardNetwork'   => ['code' => 'VISA', 'name' => 'Visa'],
                'paymentMethod'       => ['code' => 'CC'],
                'integrationType'     => 'type-1',
                'authorizationNumber' => 'auth-1',
                'beneficiaryCnpj'     => 'cnpj-1',
                'paymentTerminalId'   => 'terminal-1',
            ]
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('credit_card', $model->getMethod());
        $this->assertSame('desc', $model->getDescription());
        $this->assertSame(3, $model->getParcels());
        $this->assertSame(100.0, $model->getValue());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getPaymentDt());
        $this->assertSame('2026-01-01', $model->getPaymentDt()->format('Y-m-d'));
        $this->assertInstanceOf(RegistrationNumberApi::class, $model->getIntermediary());
        $this->assertInstanceOf(RegistrationNumberApi::class, $model->getAcquirer());
        $this->assertInstanceOf(CreditCardNetworkApi::class, $model->getCreditCardNetwork());
        $this->assertInstanceOf(PaymentMethod::class, $model->getPaymentMethod());
        $this->assertSame('type-1', $model->getIntegrationType());
        $this->assertSame('auth-1', $model->getAuthorizationNumber());
        $this->assertSame('cnpj-1', $model->getBeneficiaryCnpj());
        $this->assertSame('terminal-1', $model->getPaymentTerminalId());
    }

    public function testConstructorWithAllNulls(): void
    {
        $model = $this->serviceProvider()->create(PaymentApi::class, []);

        $this->assertNull($model->getMethod());
        $this->assertNull($model->getDescription());
        $this->assertNull($model->getParcels());
        $this->assertNull($model->getValue());
        $this->assertNull($model->getPaymentDt());
        $this->assertNull($model->getIntermediary());
        $this->assertNull($model->getAcquirer());
        $this->assertNull($model->getCreditCardNetwork());
        $this->assertNull($model->getPaymentMethod());
        $this->assertNull($model->getIntegrationType());
        $this->assertNull($model->getAuthorizationNumber());
        $this->assertNull($model->getBeneficiaryCnpj());
        $this->assertNull($model->getPaymentTerminalId());
    }

    public function testConstructorPassesThroughAlreadyHydratedInstances(): void
    {
        $intermediary  = new RegistrationNumberApi('Interm', '111');
        $acquirer      = new RegistrationNumberApi('Acquirer', '222');
        $network       = new CreditCardNetworkApi('VISA', 'Visa');
        $paymentDate   = new DateTime('2026-05-01');
        $paymentMethod = $this->serviceProvider()->create(PaymentMethod::class, []);

        $model = $this->buildModel([
            'intermediary'      => $intermediary,
            'acquirer'          => $acquirer,
            'creditCardNetwork' => $network,
            'paymentDt'         => $paymentDate,
            'paymentMethod'     => $paymentMethod,
        ]);

        $this->assertSame($intermediary, $model->getIntermediary());
        $this->assertSame($acquirer, $model->getAcquirer());
        $this->assertSame($network, $model->getCreditCardNetwork());
        $this->assertSame($paymentDate, $model->getPaymentDt());
        $this->assertSame($paymentMethod, $model->getPaymentMethod());
    }

    public function testSetters(): void
    {
        $model         = $this->buildModel();
        $intermediary  = new RegistrationNumberApi('New', '333');
        $acquirer      = new RegistrationNumberApi('New2', '444');
        $network       = new CreditCardNetworkApi('MASTER', 'Master');
        $paymentDate   = new DateTime('2026-06-01');
        $paymentMethod = $this->serviceProvider()->create(PaymentMethod::class, []);

        $model->setMethod('debit_card');
        $model->setDescription('desc2');
        $model->setParcels(1);
        $model->setValue(50.0);
        $model->setPaymentDt($paymentDate);
        $model->setIntermediary($intermediary);
        $model->setAcquirer($acquirer);
        $model->setCreditCardNetwork($network);
        $model->setPaymentMethod($paymentMethod);
        $model->setIntegrationType('type-2');
        $model->setAuthorizationNumber('auth-2');
        $model->setBeneficiaryCnpj('cnpj-2');
        $model->setPaymentTerminalId('terminal-2');

        $this->assertSame('debit_card', $model->getMethod());
        $this->assertSame('desc2', $model->getDescription());
        $this->assertSame(1, $model->getParcels());
        $this->assertSame(50.0, $model->getValue());
        $this->assertSame($paymentDate, $model->getPaymentDt());
        $this->assertSame($intermediary, $model->getIntermediary());
        $this->assertSame($acquirer, $model->getAcquirer());
        $this->assertSame($network, $model->getCreditCardNetwork());
        $this->assertSame($paymentMethod, $model->getPaymentMethod());
        $this->assertSame('type-2', $model->getIntegrationType());
        $this->assertSame('auth-2', $model->getAuthorizationNumber());
        $this->assertSame('cnpj-2', $model->getBeneficiaryCnpj());
        $this->assertSame('terminal-2', $model->getPaymentTerminalId());
    }
}
