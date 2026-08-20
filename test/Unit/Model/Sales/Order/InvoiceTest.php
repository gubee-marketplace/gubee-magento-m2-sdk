<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\AmbientEnum;
use Gubee\SDK\Enum\Sales\Order\BuyerPresenceEnum;
use Gubee\SDK\Enum\Sales\Order\PurposeEnum;
use Gubee\SDK\Enum\Sales\Order\StatusEnum;
use Gubee\SDK\Enum\Sales\Order\TypeEnum;
use Gubee\SDK\Model\Invoice\InvoiceItem;
use Gubee\SDK\Model\Invoice\ISSQNCalculation;
use Gubee\SDK\Model\Invoice\Issuer;
use Gubee\SDK\Model\Sales\Order\Carrier;
use Gubee\SDK\Model\Sales\Order\Customer;
use Gubee\SDK\Model\Sales\Order\Invoice;
use Gubee\SDK\Model\Sales\Order\PaymentMethod;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function buildModel(array $overrides = []): Invoice
    {
        $defaults = [
            'line'                    => 'line-1',
            'issueDate'               => '2026-01-01',
            'danfeXml'                => 'xml-1',
            'danfeLink'               => 'link-1',
            'key'                     => 'key-1',
            'number'                  => 'number-1',
            'id'                      => 'id-1',
            'sellerId'                => 'seller-1',
            'storeId'                 => 'store-1',
            'operationType'           => 'op-1',
            'status'                  => 'CREATED',
            'type'                    => 'IN',
            'issuer'                  => ['name' => 'Issuer One'],
            'series'                  => 1,
            'purpose'                 => 'NORMAL',
            'orderId'                 => 'order-1',
            'finalConsumer'           => true,
            'buyerPresence'           => 'NOT_APPLICABLE',
            'externalId'              => 'ext-1',
            'reversed'                => false,
            'customer'                => ['name' => 'Customer One'],
            'items'                   => [['code' => 'item-1']],
            'additionalData'          => 'data-1',
            'issQNCalculation'        => ['municipalRegistration' => 'mr-1'],
            'createdDt'               => '2026-01-02',
            'correctionLetterXmlLink' => 'clxml-1',
            'correctionLetterPdfLink' => 'clpdf-1',
            'carrier'                 => ['name' => 'Carrier One'],
            'ambient'                 => 'PRD',
            'paymentMethods'          => [['code' => 'pm-1']],
            'creditInvoiceType'       => 'credit-1',
            'debitInvoiceType'        => 'debit-1',
            'intermediateCNPJ'        => 'cnpj-1',
            'intermediateId'          => 'intermediate-1',
            'totalProductsValue'      => 100.0,
            'totalNfValue'            => 110.0,
        ];
        $args     = $overrides + $defaults;

        return new Invoice(
            $this->serviceProvider(),
            $args['line'],
            $args['issueDate'],
            $args['danfeXml'],
            $args['danfeLink'],
            $args['key'],
            $args['number'],
            $args['id'],
            $args['sellerId'],
            $args['storeId'],
            $args['operationType'],
            $args['status'],
            $args['type'],
            $args['issuer'],
            $args['series'],
            $args['purpose'],
            $args['orderId'],
            $args['finalConsumer'],
            $args['buyerPresence'],
            $args['externalId'],
            $args['reversed'],
            $args['customer'],
            $args['items'],
            $args['additionalData'],
            $args['issQNCalculation'],
            $args['createdDt'],
            $args['correctionLetterXmlLink'],
            $args['correctionLetterPdfLink'],
            $args['carrier'],
            $args['ambient'],
            $args['paymentMethods'],
            $args['creditInvoiceType'],
            $args['debitInvoiceType'],
            $args['intermediateCNPJ'],
            $args['intermediateId'],
            $args['totalProductsValue'],
            $args['totalNfValue']
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('line-1', $model->getLine());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getIssueDate());
        $this->assertSame('2026-01-01', $model->getIssueDate()->format('Y-m-d'));
        $this->assertSame('xml-1', $model->getDanfeXml());
        $this->assertSame('link-1', $model->getDanfeLink());
        $this->assertSame('key-1', $model->getKey());
        $this->assertSame('number-1', $model->getNumber());
        $this->assertSame('id-1', $model->getId());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertSame('store-1', $model->getStoreId());
        $this->assertSame('op-1', $model->getOperationType());
        $this->assertInstanceOf(StatusEnum::class, $model->getStatus());
        $this->assertInstanceOf(TypeEnum::class, $model->getType());
        $this->assertInstanceOf(Issuer::class, $model->getIssuer());
        $this->assertSame(1, $model->getSeries());
        $this->assertInstanceOf(PurposeEnum::class, $model->getPurpose());
        $this->assertSame('order-1', $model->getOrderId());
        $this->assertTrue($model->getFinalConsumer());
        $this->assertInstanceOf(BuyerPresenceEnum::class, $model->getBuyerPresence());
        $this->assertSame('ext-1', $model->getExternalId());
        $this->assertFalse($model->getReversed());
        $this->assertInstanceOf(Customer::class, $model->getCustomer());
        $this->assertContainsOnlyInstancesOf(InvoiceItem::class, $model->getItems());
        $this->assertSame('data-1', $model->getAdditionalData());
        $this->assertInstanceOf(ISSQNCalculation::class, $model->getIssQNCalculation());
        $this->assertSame('2026-01-02', $model->getCreatedDt()->format('Y-m-d'));
        $this->assertSame('clxml-1', $model->getCorrectionLetterXmlLink());
        $this->assertSame('clpdf-1', $model->getCorrectionLetterPdfLink());
        $this->assertInstanceOf(Carrier::class, $model->getCarrier());
        $this->assertInstanceOf(AmbientEnum::class, $model->getAmbient());
        $this->assertContainsOnlyInstancesOf(PaymentMethod::class, $model->getPaymentMethods());
        $this->assertSame('credit-1', $model->getCreditInvoiceType());
        $this->assertSame('debit-1', $model->getDebitInvoiceType());
        $this->assertSame('cnpj-1', $model->getIntermediateCNPJ());
        $this->assertSame('intermediate-1', $model->getIntermediateId());
        $this->assertSame(100.0, $model->getTotalProductsValue());
        $this->assertSame(110.0, $model->getTotalNfValue());
    }

    public function testConstructorWithNullOptionalFields(): void
    {
        $model = $this->buildModel([
            'danfeXml'                => null,
            'danfeLink'               => null,
            'id'                      => null,
            'sellerId'                => null,
            'storeId'                 => null,
            'operationType'           => null,
            'status'                  => null,
            'type'                    => null,
            'issuer'                  => null,
            'series'                  => null,
            'purpose'                 => null,
            'orderId'                 => null,
            'finalConsumer'           => null,
            'buyerPresence'           => null,
            'externalId'              => null,
            'reversed'                => null,
            'customer'                => null,
            'items'                   => null,
            'additionalData'          => null,
            'issQNCalculation'        => null,
            'createdDt'               => null,
            'correctionLetterXmlLink' => null,
            'correctionLetterPdfLink' => null,
            'carrier'                 => null,
            'ambient'                 => null,
            'paymentMethods'          => null,
            'creditInvoiceType'       => null,
            'debitInvoiceType'        => null,
            'intermediateCNPJ'        => null,
            'intermediateId'          => null,
            'totalProductsValue'      => null,
            'totalNfValue'            => null,
        ]);

        $this->assertNull($model->getDanfeXml());
        $this->assertNull($model->getDanfeLink());
        $this->assertNull($model->getId());
        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getStoreId());
        $this->assertNull($model->getOperationType());
        $this->assertNull($model->getStatus());
        $this->assertNull($model->getType());
        $this->assertNull($model->getIssuer());
        $this->assertNull($model->getSeries());
        $this->assertNull($model->getPurpose());
        $this->assertNull($model->getOrderId());
        $this->assertNull($model->getFinalConsumer());
        $this->assertNull($model->getBuyerPresence());
        $this->assertNull($model->getExternalId());
        $this->assertNull($model->getReversed());
        $this->assertNull($model->getCustomer());
        $this->assertNull($model->getItems());
        $this->assertNull($model->getAdditionalData());
        $this->assertNull($model->getIssQNCalculation());
        $this->assertNull($model->getCreatedDt());
        $this->assertNull($model->getCorrectionLetterXmlLink());
        $this->assertNull($model->getCorrectionLetterPdfLink());
        $this->assertNull($model->getCarrier());
        $this->assertNull($model->getAmbient());
        $this->assertNull($model->getPaymentMethods());
        $this->assertNull($model->getCreditInvoiceType());
        $this->assertNull($model->getDebitInvoiceType());
        $this->assertNull($model->getIntermediateCNPJ());
        $this->assertNull($model->getIntermediateId());
        $this->assertNull($model->getTotalProductsValue());
        $this->assertNull($model->getTotalNfValue());
    }

    public function testConstructorAcceptsAlreadyHydratedInstancesAndEnums(): void
    {
        $issueDate     = new DateTime('2026-04-01');
        $issuer        = new Issuer($this->serviceProvider(), 'Issuer Two');
        $customer      = new Customer($this->serviceProvider(), 'Customer Two');
        $item          = $this->serviceProvider()->create(InvoiceItem::class, []);
        $issqn         = new ISSQNCalculation('mr-2');
        $createdDt     = new DateTime('2026-04-02');
        $carrier       = new Carrier($this->serviceProvider(), 'cpf-2');
        $paymentMethod = new PaymentMethod();

        $model = $this->buildModel([
            'issueDate'        => $issueDate,
            'status'           => StatusEnum::fromValue('PAYED'),
            'type'             => TypeEnum::fromValue('OUT'),
            'issuer'           => $issuer,
            'purpose'          => PurposeEnum::fromValue('CREDIT'),
            'buyerPresence'    => BuyerPresenceEnum::fromValue('REMOTE_OPERATION_INTERNET'),
            'customer'         => $customer,
            'items'            => [$item],
            'issQNCalculation' => $issqn,
            'createdDt'        => $createdDt,
            'carrier'          => $carrier,
            'ambient'          => AmbientEnum::fromValue('HML'),
            'paymentMethods'   => [$paymentMethod],
        ]);

        $this->assertSame($issueDate, $model->getIssueDate());
        $this->assertSame('PAYED', (string) $model->getStatus());
        $this->assertSame('OUT', (string) $model->getType());
        $this->assertSame($issuer, $model->getIssuer());
        $this->assertSame('CREDIT', (string) $model->getPurpose());
        $this->assertSame('REMOTE_OPERATION_INTERNET', (string) $model->getBuyerPresence());
        $this->assertSame($customer, $model->getCustomer());
        $this->assertSame($item, $model->getItems()[0]);
        $this->assertSame($issqn, $model->getIssQNCalculation());
        $this->assertSame($createdDt, $model->getCreatedDt());
        $this->assertSame($carrier, $model->getCarrier());
        $this->assertSame('HML', (string) $model->getAmbient());
        $this->assertSame($paymentMethod, $model->getPaymentMethods()[0]);
    }

    public function testSetters(): void
    {
        $model         = $this->buildModel();
        $date          = new DateTime('2026-05-01');
        $issuer        = new Issuer($this->serviceProvider(), 'Issuer Three');
        $customer      = new Customer($this->serviceProvider(), 'Customer Three');
        $item          = $this->serviceProvider()->create(InvoiceItem::class, []);
        $issqn         = new ISSQNCalculation('mr-3');
        $carrier       = new Carrier($this->serviceProvider(), 'cpf-3');
        $paymentMethod = new PaymentMethod();

        $model->setLine('line-2');
        $model->setIssueDate($date);
        $model->setDanfeXml('xml-2');
        $model->setDanfeLink('link-2');
        $model->setKey('key-2');
        $model->setNumber('number-2');
        $model->setId('id-2');
        $model->setSellerId('seller-2');
        $model->setStoreId('store-2');
        $model->setOperationType('op-2');
        $model->setStatus(StatusEnum::fromValue('CONCLUDED'));
        $model->setType(TypeEnum::fromValue('OUT'));
        $model->setIssuer($issuer);
        $model->setSeries(2);
        $model->setPurpose(PurposeEnum::fromValue('DEBIT'));
        $model->setOrderId('order-2');
        $model->setFinalConsumer(false);
        $model->setBuyerPresence(BuyerPresenceEnum::fromValue('REMOTE_OPERATION_OTHER'));
        $model->setExternalId('ext-2');
        $model->setReversed(true);
        $model->setCustomer($customer);
        $model->setItems([$item]);
        $model->setAdditionalData('data-2');
        $model->setIssQNCalculation($issqn);
        $model->setCreatedDt($date);
        $model->setCorrectionLetterXmlLink('clxml-2');
        $model->setCorrectionLetterPdfLink('clpdf-2');
        $model->setCarrier($carrier);
        $model->setAmbient(AmbientEnum::fromValue('PRD'));
        $model->setPaymentMethods([$paymentMethod]);
        $model->setCreditInvoiceType('credit-2');
        $model->setDebitInvoiceType('debit-2');
        $model->setIntermediateCNPJ('cnpj-2');
        $model->setIntermediateId('intermediate-2');
        $model->setTotalProductsValue(200.0);
        $model->setTotalNfValue(220.0);

        $this->assertSame('line-2', $model->getLine());
        $this->assertSame($date, $model->getIssueDate());
        $this->assertSame('xml-2', $model->getDanfeXml());
        $this->assertSame('link-2', $model->getDanfeLink());
        $this->assertSame('key-2', $model->getKey());
        $this->assertSame('number-2', $model->getNumber());
        $this->assertSame('id-2', $model->getId());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame('store-2', $model->getStoreId());
        $this->assertSame('op-2', $model->getOperationType());
        $this->assertSame('CONCLUDED', (string) $model->getStatus());
        $this->assertSame('OUT', (string) $model->getType());
        $this->assertSame($issuer, $model->getIssuer());
        $this->assertSame(2, $model->getSeries());
        $this->assertSame('DEBIT', (string) $model->getPurpose());
        $this->assertSame('order-2', $model->getOrderId());
        $this->assertFalse($model->getFinalConsumer());
        $this->assertSame('REMOTE_OPERATION_OTHER', (string) $model->getBuyerPresence());
        $this->assertSame('ext-2', $model->getExternalId());
        $this->assertTrue($model->getReversed());
        $this->assertSame($customer, $model->getCustomer());
        $this->assertSame([$item], $model->getItems());
        $this->assertSame('data-2', $model->getAdditionalData());
        $this->assertSame($issqn, $model->getIssQNCalculation());
        $this->assertSame($date, $model->getCreatedDt());
        $this->assertSame('clxml-2', $model->getCorrectionLetterXmlLink());
        $this->assertSame('clpdf-2', $model->getCorrectionLetterPdfLink());
        $this->assertSame($carrier, $model->getCarrier());
        $this->assertSame('PRD', (string) $model->getAmbient());
        $this->assertSame([$paymentMethod], $model->getPaymentMethods());
        $this->assertSame('credit-2', $model->getCreditInvoiceType());
        $this->assertSame('debit-2', $model->getDebitInvoiceType());
        $this->assertSame('cnpj-2', $model->getIntermediateCNPJ());
        $this->assertSame('intermediate-2', $model->getIntermediateId());
        $this->assertSame(200.0, $model->getTotalProductsValue());
        $this->assertSame(220.0, $model->getTotalNfValue());
    }
}
