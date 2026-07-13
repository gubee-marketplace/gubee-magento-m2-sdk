<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Sales\Order\ItemApi;
use Gubee\SDK\Model\Sales\Order\MarketplaceShipmentApi;
use Gubee\SDK\Model\Sales\Order\Tracking;
use Gubee\SDK\Model\Sales\Order\Transport;
use PHPUnit\Framework\TestCase;

class MarketplaceShipmentApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): MarketplaceShipmentApi
    {
        $defaults = [
            'code'                => 'code-1',
            'invoiceKey'          => 'invoice-key-1',
            'transport'           => ['carrier' => 'carrier-1', 'method' => 'method-1', 'link' => 'link-1', 'trackingCode' => null, 'deliveredCarrierDate' => '2026-01-01'],
            'items'               => [[]],
            'tracks'              => [['info' => 'track-1', 'trackDt' => '2026-01-02']],
            'estimatedDeliveryDt' => '2026-01-03',
            'deliveredDt'         => '2026-01-04',
            'additionalInfo'      => ['key' => 'value'],
        ];
        $args     = $overrides + $defaults;

        return new MarketplaceShipmentApi(
            $this->serviceProvider(),
            $args['code'],
            $args['invoiceKey'],
            $args['transport'],
            $args['items'],
            $args['tracks'],
            $args['estimatedDeliveryDt'],
            $args['deliveredDt'],
            $args['additionalInfo']
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('code-1', $model->getCode());
        $this->assertSame('invoice-key-1', $model->getInvoiceKey());
        $this->assertInstanceOf(Transport::class, $model->getTransport());
        $this->assertContainsOnlyInstancesOf(ItemApi::class, $model->getItems());
        $this->assertContainsOnlyInstancesOf(Tracking::class, $model->getTracks());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getEstimatedDeliveryDt());
        $this->assertSame('2026-01-03', $model->getEstimatedDeliveryDt()->format('Y-m-d'));
        $this->assertSame('2026-01-04', $model->getDeliveredDt()->format('Y-m-d'));
        $this->assertSame(['key' => 'value'], $model->getAdditionalInfo());
    }

    public function testConstructorWithNullOptionalFields(): void
    {
        $model = $this->buildModel([
            'invoiceKey'          => null,
            'transport'           => null,
            'estimatedDeliveryDt' => null,
            'deliveredDt'         => null,
            'additionalInfo'      => null,
        ]);

        $this->assertNull($model->getInvoiceKey());
        $this->assertNull($model->getTransport());
        $this->assertNull($model->getEstimatedDeliveryDt());
        $this->assertNull($model->getDeliveredDt());
        $this->assertNull($model->getAdditionalInfo());
    }

    public function testConstructorPassesThroughAlreadyHydratedInstances(): void
    {
        $transport = new Transport('carrier-2', 'method-2', 'link-2', null, new DateTime('2026-02-01'));
        $item      = $this->serviceProvider()->create(ItemApi::class, []);
        $track     = new Tracking('track-2', new DateTime('2026-02-02'));

        $model = $this->buildModel([
            'transport' => $transport,
            'items'     => [$item],
            'tracks'    => [$track],
        ]);

        $this->assertSame($transport, $model->getTransport());
        $this->assertSame($item, $model->getItems()[0]);
        $this->assertSame($track, $model->getTracks()[0]);
    }

    public function testSetters(): void
    {
        $model     = $this->buildModel();
        $transport = new Transport('carrier-3', 'method-3', 'link-3', null, new DateTime('2026-03-01'));
        $item      = $this->serviceProvider()->create(ItemApi::class, []);
        $track     = new Tracking('track-3', new DateTime('2026-03-02'));
        $date      = new DateTime('2026-03-03');

        $model->setCode('code-2');
        $model->setInvoiceKey('invoice-key-2');
        $model->setTransport($transport);
        $model->setItems([$item]);
        $model->setTracks([$track]);
        $model->setEstimatedDeliveryDt($date);
        $model->setDeliveredDt($date);
        $model->setAdditionalInfo(['a' => 'b']);

        $this->assertSame('code-2', $model->getCode());
        $this->assertSame('invoice-key-2', $model->getInvoiceKey());
        $this->assertSame($transport, $model->getTransport());
        $this->assertSame([$item], $model->getItems());
        $this->assertSame([$track], $model->getTracks());
        $this->assertSame($date, $model->getEstimatedDeliveryDt());
        $this->assertSame($date, $model->getDeliveredDt());
        $this->assertSame(['a' => 'b'], $model->getAdditionalInfo());
    }
}
