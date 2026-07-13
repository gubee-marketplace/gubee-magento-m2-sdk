<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\FreightTypeEnum;
use Gubee\SDK\Enum\Sales\Order\OrderTypeEnum;
use Gubee\SDK\Enum\Sales\Order\OriginDomainTypeEnum;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Sales\Order\Invoice;
use Gubee\SDK\Model\Sales\Order\ItemApi;
use Gubee\SDK\Model\Sales\Order\LogisticTypeApi;
use Gubee\SDK\Model\Sales\Order\MarketplaceShipmentApi;
use Gubee\SDK\Model\Sales\Order\OrderApi;
use Gubee\SDK\Model\Sales\Order\OrderCustomerApi;
use Gubee\SDK\Model\Sales\Order\OrderProfitabilityApi;
use Gubee\SDK\Model\Sales\Order\OrderStatusApi;
use Gubee\SDK\Model\Sales\Order\PaymentApi;
use Gubee\SDK\Model\Sales\Order\Shipment;
use PHPUnit\Framework\TestCase;

class OrderApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function buildModel(array $overrides = []): OrderApi
    {
        $defaults = [
            'id'                             => 'order-1',
            'plataform'                      => 'plataform-1',
            'sellerId'                       => 'seller-1',
            'accountId'                      => 'account-1',
            'externalId'                     => 'ext-1',
            'displayId'                      => 'display-1',
            'createdDt'                      => '2026-01-01',
            'lastModifiedDt'                 => '2026-01-02',
            'channel'                        => 'channel-1',
            'statusHistory'                  => [['status' => 'CREATED', 'marketplaceStatus' => 'created', 'statusDt' => '2026-01-01']],
            'status'                         => ['status' => 'CREATED', 'marketplaceStatus' => 'created', 'statusDt' => '2026-01-01'],
            'orderType'                      => 'SALE',
            'items'                          => [[]],
            'customer'                       => [
                'name'          => 'Customer One',
                'recipientName' => null,
                'receiverName'  => null,
                'email'         => null,
                'dateOfBirth'   => null,
                'gender'        => null,
                'documents'     => [],
                'phones'        => [],
            ],
            'billingAddress'                 => ['street' => 'Street One'],
            'shippingAddress'                => ['street' => 'Street Two'],
            'shippingMethod'                 => 'method-1',
            'invoices'                       => [],
            'shipments'                      => [],
            'marketplaceShipments'           => [
                [
                    'code'       => 'mshipment-1',
                    'invoiceKey' => null,
                    'transport'  => null,
                    'items'      => [],
                    'tracks'     => [],
                ],
            ],
            'payments'                       => [[]],
            'shippingCost'                   => 10.0,
            'logisticType'                   => ['name' => 'Logistic One'],
            'totalInterest'                  => 1.0,
            'totalCommission'                => 2.0,
            'totalDiscount'                  => 3.0,
            'totalFreight'                   => 4.0,
            'totalGross'                     => 5.0,
            'totalNet'                       => 6.0,
            'totalQuantity'                  => 7,
            'freightType'                    => 'NORMAL',
            'marketplaceEstimatedDeliveryDt' => '2026-01-03',
            'originDomainType'               => 'PRODUCT',
            'additionalInfo'                 => ['key' => 'value'],
            'marketplaceDeadlineShippingDt'  => '2026-01-04',
            'marketplaceDiscount'            => 8.0,
            'shippingDiscount'               => 9.0,
            'serviceFee'                     => 10.0,
            'tags'                           => ['tag-1'],
            'totalCost'                      => 11.0,
            'grossProfit'                    => 12.0,
            'grossMargin'                    => 13.0,
            'costEnrichmentStatus'           => 'status-1',
            'profitability'                  => ['totalCost' => 1.0],
        ];
        $args     = $overrides + $defaults;

        return new OrderApi(
            $this->serviceProvider(),
            $args['id'],
            $args['plataform'],
            $args['sellerId'],
            $args['accountId'],
            $args['externalId'],
            $args['displayId'],
            $args['createdDt'],
            $args['lastModifiedDt'],
            $args['channel'],
            $args['statusHistory'],
            $args['status'],
            $args['orderType'],
            $args['items'],
            $args['customer'],
            $args['billingAddress'],
            $args['shippingAddress'],
            $args['shippingMethod'],
            $args['invoices'],
            $args['shipments'],
            $args['marketplaceShipments'],
            $args['payments'],
            $args['shippingCost'],
            $args['logisticType'],
            $args['totalInterest'],
            $args['totalCommission'],
            $args['totalDiscount'],
            $args['totalFreight'],
            $args['totalGross'],
            $args['totalNet'],
            $args['totalQuantity'],
            $args['freightType'],
            $args['marketplaceEstimatedDeliveryDt'],
            $args['originDomainType'],
            $args['additionalInfo'],
            $args['marketplaceDeadlineShippingDt'],
            $args['marketplaceDiscount'],
            $args['shippingDiscount'],
            $args['serviceFee'],
            $args['tags'],
            $args['totalCost'],
            $args['grossProfit'],
            $args['grossMargin'],
            $args['costEnrichmentStatus'],
            $args['profitability']
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('order-1', $model->getId());
        $this->assertSame('plataform-1', $model->getPlataform());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertSame('account-1', $model->getAccountId());
        $this->assertSame('ext-1', $model->getExternalId());
        $this->assertSame('display-1', $model->getDisplayId());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getCreatedDt());
        $this->assertSame('2026-01-01', $model->getCreatedDt()->format('Y-m-d'));
        $this->assertSame('2026-01-02', $model->getLastModifiedDt()->format('Y-m-d'));
        $this->assertSame('channel-1', $model->getChannel());
        $this->assertContainsOnlyInstancesOf(OrderStatusApi::class, $model->getStatusHistory());
        $this->assertInstanceOf(OrderStatusApi::class, $model->getStatus());
        $this->assertInstanceOf(OrderTypeEnum::class, $model->getOrderType());
        $this->assertContainsOnlyInstancesOf(ItemApi::class, $model->getItems());
        $this->assertInstanceOf(OrderCustomerApi::class, $model->getCustomer());
        $this->assertInstanceOf(Address::class, $model->getBillingAddress());
        $this->assertInstanceOf(Address::class, $model->getShippingAddress());
        $this->assertSame('method-1', $model->getShippingMethod());
        $this->assertSame([], $model->getInvoices());
        $this->assertSame([], $model->getShipments());
        $this->assertContainsOnlyInstancesOf(MarketplaceShipmentApi::class, $model->getMarketplaceShipments());
        $this->assertContainsOnlyInstancesOf(PaymentApi::class, $model->getPayments());
        $this->assertSame(10.0, $model->getShippingCost());
        $this->assertInstanceOf(LogisticTypeApi::class, $model->getLogisticType());
        $this->assertSame(1.0, $model->getTotalInterest());
        $this->assertSame(2.0, $model->getTotalCommission());
        $this->assertSame(3.0, $model->getTotalDiscount());
        $this->assertSame(4.0, $model->getTotalFreight());
        $this->assertSame(5.0, $model->getTotalGross());
        $this->assertSame(6.0, $model->getTotalNet());
        $this->assertSame(7, $model->getTotalQuantity());
        $this->assertInstanceOf(FreightTypeEnum::class, $model->getFreightType());
        $this->assertSame('2026-01-03', $model->getMarketplaceEstimatedDeliveryDt()->format('Y-m-d'));
        $this->assertInstanceOf(OriginDomainTypeEnum::class, $model->getOriginDomainType());
        $this->assertSame(['key' => 'value'], $model->getAdditionalInfo());
        $this->assertSame('2026-01-04', $model->getMarketplaceDeadlineShippingDt()->format('Y-m-d'));
        $this->assertSame(8.0, $model->getMarketplaceDiscount());
        $this->assertSame(9.0, $model->getShippingDiscount());
        $this->assertSame(10.0, $model->getServiceFee());
        $this->assertSame(['tag-1'], $model->getTags());
        $this->assertSame(11.0, $model->getTotalCost());
        $this->assertSame(12.0, $model->getGrossProfit());
        $this->assertSame(13.0, $model->getGrossMargin());
        $this->assertSame('status-1', $model->getCostEnrichmentStatus());
        $this->assertInstanceOf(OrderProfitabilityApi::class, $model->getProfitability());
    }

    public function testConstructorHydratesShipmentsFromRawArrays(): void
    {
        $model = $this->buildModel([
            'shipments' => [
                [
                    'code'                => 'shipment-1',
                    'invoiceKey'          => null,
                    'transport'           => ['carrier' => 'carrier-1', 'method' => 'method-1', 'link' => 'link-1', 'trackingCode' => null, 'deliveredCarrierDate' => '2026-01-01'],
                    'items'               => [],
                    'tracks'              => [],
                    'estimatedDeliveryDt' => '2026-01-05',
                ],
            ],
        ]);

        $this->assertContainsOnlyInstancesOf(Shipment::class, $model->getShipments());
    }

    public function testConstructorHydratesInvoicesFromRawArrays(): void
    {
        $model = $this->buildModel([
            'invoices' => [
                [
                    'line'      => 'line-1',
                    'issueDate' => '2026-01-01',
                    'danfeXml'  => null,
                    'danfeLink' => null,
                    'key'       => 'key-1',
                    'number'    => 'number-1',
                ],
            ],
        ]);

        $this->assertContainsOnlyInstancesOf(Invoice::class, $model->getInvoices());
    }

    public function testConstructorWithNullOptionalFields(): void
    {
        $model = $this->buildModel([
            'plataform'                      => null,
            'sellerId'                       => null,
            'accountId'                      => null,
            'displayId'                      => null,
            'createdDt'                      => null,
            'lastModifiedDt'                 => null,
            'status'                         => null,
            'customer'                       => null,
            'billingAddress'                 => null,
            'shippingAddress'                => null,
            'shippingMethod'                 => null,
            'marketplaceShipments'           => null,
            'shippingCost'                   => null,
            'logisticType'                   => null,
            'totalInterest'                  => null,
            'totalCommission'                => null,
            'totalDiscount'                  => null,
            'totalFreight'                   => null,
            'totalGross'                     => null,
            'totalNet'                       => null,
            'totalQuantity'                  => null,
            'marketplaceEstimatedDeliveryDt' => null,
            'originDomainType'               => null,
            'additionalInfo'                 => null,
            'marketplaceDeadlineShippingDt'  => null,
            'marketplaceDiscount'            => null,
            'shippingDiscount'               => null,
            'serviceFee'                     => null,
            'totalCost'                      => null,
            'grossProfit'                    => null,
            'grossMargin'                    => null,
            'costEnrichmentStatus'           => null,
            'profitability'                  => null,
        ]);

        $this->assertNull($model->getPlataform());
        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getAccountId());
        $this->assertNull($model->getDisplayId());
        $this->assertNull($model->getCreatedDt());
        $this->assertNull($model->getLastModifiedDt());
        $this->assertNull($model->getStatus());
        $this->assertNull($model->getCustomer());
        $this->assertNull($model->getBillingAddress());
        $this->assertNull($model->getShippingAddress());
        $this->assertNull($model->getShippingMethod());
        $this->assertNull($model->getMarketplaceShipments());
        $this->assertNull($model->getShippingCost());
        $this->assertNull($model->getLogisticType());
        $this->assertNull($model->getTotalInterest());
        $this->assertNull($model->getTotalCommission());
        $this->assertNull($model->getTotalDiscount());
        $this->assertNull($model->getTotalFreight());
        $this->assertNull($model->getTotalGross());
        $this->assertNull($model->getTotalNet());
        $this->assertNull($model->getTotalQuantity());
        $this->assertNull($model->getMarketplaceEstimatedDeliveryDt());
        $this->assertNull($model->getOriginDomainType());
        $this->assertNull($model->getAdditionalInfo());
        $this->assertNull($model->getMarketplaceDeadlineShippingDt());
        $this->assertNull($model->getMarketplaceDiscount());
        $this->assertNull($model->getShippingDiscount());
        $this->assertNull($model->getServiceFee());
        $this->assertNull($model->getTotalCost());
        $this->assertNull($model->getGrossProfit());
        $this->assertNull($model->getGrossMargin());
        $this->assertNull($model->getCostEnrichmentStatus());
        $this->assertNull($model->getProfitability());
    }

    public function testConstructorAcceptsAlreadyHydratedInstancesAndEnums(): void
    {
        $createdDt             = new DateTime('2026-06-01');
        $lastModifiedDt        = new DateTime('2026-06-02');
        $status                = $this->serviceProvider()->create(
            OrderStatusApi::class,
            ['status' => 'CREATED', 'marketplaceStatus' => 'created', 'statusDt' => '2026-01-01']
        );
        $item                  = $this->serviceProvider()->create(ItemApi::class, []);
        $customer              = new OrderCustomerApi($this->serviceProvider(), null, null, null, null, null, null, [], []);
        $address               = $this->serviceProvider()->create(Address::class, []);
        $marketplaceShipment   = $this->serviceProvider()->create(MarketplaceShipmentApi::class, ['code' => 'code-1', 'invoiceKey' => null, 'transport' => null, 'items' => [], 'tracks' => []]);
        $payment               = $this->serviceProvider()->create(PaymentApi::class, []);
        $logisticType          = new LogisticTypeApi();
        $marketplaceEstDt      = new DateTime('2026-06-03');
        $marketplaceDeadlineDt = new DateTime('2026-06-04');
        $profitability         = new OrderProfitabilityApi();

        $model = $this->buildModel([
            'createdDt'                      => $createdDt,
            'lastModifiedDt'                 => $lastModifiedDt,
            'statusHistory'                  => [$status],
            'status'                         => $status,
            'orderType'                      => OrderTypeEnum::fromValue('RETURN'),
            'items'                          => [$item],
            'customer'                       => $customer,
            'billingAddress'                 => $address,
            'shippingAddress'                => $address,
            'marketplaceShipments'           => [$marketplaceShipment],
            'payments'                       => [$payment],
            'logisticType'                   => $logisticType,
            'freightType'                    => FreightTypeEnum::fromValue('EXPRESS'),
            'marketplaceEstimatedDeliveryDt' => $marketplaceEstDt,
            'originDomainType'               => OriginDomainTypeEnum::fromValue('AD'),
            'marketplaceDeadlineShippingDt'  => $marketplaceDeadlineDt,
            'profitability'                  => $profitability,
        ]);

        $this->assertSame($createdDt, $model->getCreatedDt());
        $this->assertSame($lastModifiedDt, $model->getLastModifiedDt());
        $this->assertSame($status, $model->getStatusHistory()[0]);
        $this->assertSame($status, $model->getStatus());
        $this->assertSame('RETURN', (string) $model->getOrderType());
        $this->assertSame($item, $model->getItems()[0]);
        $this->assertSame($customer, $model->getCustomer());
        $this->assertSame($address, $model->getBillingAddress());
        $this->assertSame($address, $model->getShippingAddress());
        $this->assertSame($marketplaceShipment, $model->getMarketplaceShipments()[0]);
        $this->assertSame($payment, $model->getPayments()[0]);
        $this->assertSame($logisticType, $model->getLogisticType());
        $this->assertSame('EXPRESS', (string) $model->getFreightType());
        $this->assertSame($marketplaceEstDt, $model->getMarketplaceEstimatedDeliveryDt());
        $this->assertSame('AD', (string) $model->getOriginDomainType());
        $this->assertSame($marketplaceDeadlineDt, $model->getMarketplaceDeadlineShippingDt());
        $this->assertSame($profitability, $model->getProfitability());
    }

    public function testSetters(): void
    {
        $model               = $this->buildModel();
        $date                = new DateTime('2026-07-01');
        $status              = $this->serviceProvider()->create(
            OrderStatusApi::class,
            ['status' => 'CREATED', 'marketplaceStatus' => 'created', 'statusDt' => '2026-01-01']
        );
        $item                = $this->serviceProvider()->create(ItemApi::class, []);
        $customer            = new OrderCustomerApi($this->serviceProvider(), null, null, null, null, null, null, [], []);
        $address             = $this->serviceProvider()->create(Address::class, []);
        $invoice             = new Invoice($this->serviceProvider(), 'line-2', new DateTime('2026-01-01'), null, null, 'key-2', 'number-2');
        $shipment            = new Shipment(
            $this->serviceProvider(),
            'shipment-2',
            null,
            ['carrier' => 'c', 'method' => 'm', 'link' => 'l', 'trackingCode' => null, 'deliveredCarrierDate' => new DateTime('2026-01-01')],
            [],
            [],
            new DateTime('2026-01-01')
        );
        $marketplaceShipment = $this->serviceProvider()->create(MarketplaceShipmentApi::class, ['code' => 'code-2', 'invoiceKey' => null, 'transport' => null, 'items' => [], 'tracks' => []]);
        $payment             = $this->serviceProvider()->create(PaymentApi::class, []);
        $logisticType        = new LogisticTypeApi();
        $profitability       = new OrderProfitabilityApi();

        $model->setId('order-2');
        $model->setPlataform('plataform-2');
        $model->setSellerId('seller-2');
        $model->setAccountId('account-2');
        $model->setExternalId('ext-2');
        $model->setDisplayId('display-2');
        $model->setCreatedDt($date);
        $model->setLastModifiedDt($date);
        $model->setChannel('channel-2');
        $model->setStatusHistory([$status]);
        $model->setStatus($status);
        $model->setOrderType(OrderTypeEnum::fromValue('EXCHANGE'));
        $model->setItems([$item]);
        $model->setCustomer($customer);
        $model->setBillingAddress($address);
        $model->setShippingAddress($address);
        $model->setShippingMethod('method-2');
        $model->setInvoices([$invoice]);
        $model->setShipments([$shipment]);
        $model->setMarketplaceShipments([$marketplaceShipment]);
        $model->setPayments([$payment]);
        $model->setShippingCost(20.0);
        $model->setLogisticType($logisticType);
        $model->setTotalInterest(21.0);
        $model->setTotalCommission(22.0);
        $model->setTotalDiscount(23.0);
        $model->setTotalFreight(24.0);
        $model->setTotalGross(25.0);
        $model->setTotalNet(26.0);
        $model->setTotalQuantity(27);
        $model->setFreightType(FreightTypeEnum::fromValue('PICKUP'));
        $model->setMarketplaceEstimatedDeliveryDt($date);
        $model->setOriginDomainType(OriginDomainTypeEnum::fromValue('AD'));
        $model->setAdditionalInfo(['a' => 'b']);
        $model->setMarketplaceDeadlineShippingDt($date);
        $model->setMarketplaceDiscount(28.0);
        $model->setShippingDiscount(29.0);
        $model->setServiceFee(30.0);
        $model->setTags(['tag-2']);
        $model->setTotalCost(31.0);
        $model->setGrossProfit(32.0);
        $model->setGrossMargin(33.0);
        $model->setCostEnrichmentStatus('status-2');
        $model->setProfitability($profitability);

        $this->assertSame('order-2', $model->getId());
        $this->assertSame('plataform-2', $model->getPlataform());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame('account-2', $model->getAccountId());
        $this->assertSame('ext-2', $model->getExternalId());
        $this->assertSame('display-2', $model->getDisplayId());
        $this->assertSame($date, $model->getCreatedDt());
        $this->assertSame($date, $model->getLastModifiedDt());
        $this->assertSame('channel-2', $model->getChannel());
        $this->assertSame([$status], $model->getStatusHistory());
        $this->assertSame($status, $model->getStatus());
        $this->assertSame('EXCHANGE', (string) $model->getOrderType());
        $this->assertSame([$item], $model->getItems());
        $this->assertSame($customer, $model->getCustomer());
        $this->assertSame($address, $model->getBillingAddress());
        $this->assertSame($address, $model->getShippingAddress());
        $this->assertSame('method-2', $model->getShippingMethod());
        $this->assertSame([$invoice], $model->getInvoices());
        $this->assertSame([$shipment], $model->getShipments());
        $this->assertSame([$marketplaceShipment], $model->getMarketplaceShipments());
        $this->assertSame([$payment], $model->getPayments());
        $this->assertSame(20.0, $model->getShippingCost());
        $this->assertSame($logisticType, $model->getLogisticType());
        $this->assertSame(21.0, $model->getTotalInterest());
        $this->assertSame(22.0, $model->getTotalCommission());
        $this->assertSame(23.0, $model->getTotalDiscount());
        $this->assertSame(24.0, $model->getTotalFreight());
        $this->assertSame(25.0, $model->getTotalGross());
        $this->assertSame(26.0, $model->getTotalNet());
        $this->assertSame(27, $model->getTotalQuantity());
        $this->assertSame('PICKUP', (string) $model->getFreightType());
        $this->assertSame($date, $model->getMarketplaceEstimatedDeliveryDt());
        $this->assertSame('AD', (string) $model->getOriginDomainType());
        $this->assertSame(['a' => 'b'], $model->getAdditionalInfo());
        $this->assertSame($date, $model->getMarketplaceDeadlineShippingDt());
        $this->assertSame(28.0, $model->getMarketplaceDiscount());
        $this->assertSame(29.0, $model->getShippingDiscount());
        $this->assertSame(30.0, $model->getServiceFee());
        $this->assertSame(['tag-2'], $model->getTags());
        $this->assertSame(31.0, $model->getTotalCost());
        $this->assertSame(32.0, $model->getGrossProfit());
        $this->assertSame(33.0, $model->getGrossMargin());
        $this->assertSame('status-2', $model->getCostEnrichmentStatus());
        $this->assertSame($profitability, $model->getProfitability());
    }
}
