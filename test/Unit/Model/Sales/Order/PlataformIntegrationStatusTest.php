<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\PlatformIntegrationStatusEnum;
use Gubee\SDK\Model\Notification\IntegrationNotification;
use Gubee\SDK\Model\Platform\SetUp;
use Gubee\SDK\Model\Sales\Order\PlataformIntegrationStatus;
use PHPUnit\Framework\TestCase;

class PlataformIntegrationStatusTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): PlataformIntegrationStatus
    {
        return $this->serviceProvider()->create(
            PlataformIntegrationStatus::class,
            $overrides + [
                'plataform'      => 'plat-1',
                'errors'         => [['sourceId' => 'src-1']],
                'notifications'  => [['sourceId' => 'src-2']],
                'partnerStatus'  => 'status-1',
                'lastModifiedDt' => '2026-01-01',
                'status'         => 'PENDING',
                'eventId'        => 'event-1',
                'platform'       => 'platform-1',
                'up'             => ['up' => 'up-1'],
            ]
        );
    }

    public function testHydratesNestedModelsFromRawArrays(): void
    {
        $status = $this->build();

        $this->assertSame('plat-1', $status->getPlataform());
        $this->assertContainsOnlyInstancesOf(IntegrationNotification::class, $status->getErrors());
        $this->assertContainsOnlyInstancesOf(IntegrationNotification::class, $status->getNotifications());
        $this->assertSame('status-1', $status->getPartnerStatus());
        $this->assertInstanceOf(DateTimeInterface::class, $status->getLastModifiedDt());
        $this->assertEquals(PlatformIntegrationStatusEnum::fromValue('PENDING'), $status->getStatus());
        $this->assertSame('event-1', $status->getEventId());
        $this->assertSame('platform-1', $status->getPlatform());
        $this->assertInstanceOf(SetUp::class, $status->getUp());
        $this->assertSame('up-1', $status->getUp()->getUp());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $error        = $this->serviceProvider()->create(IntegrationNotification::class, ['sourceId' => 'src-3']);
        $notification = $this->serviceProvider()->create(IntegrationNotification::class, ['sourceId' => 'src-4']);
        $up           = $this->serviceProvider()->create(SetUp::class, ['up' => 'up-2']);

        $status = $this->build([
            'errors'        => [$error],
            'notifications' => [$notification],
            'up'            => $up,
        ]);

        $this->assertSame($error, $status->getErrors()[0]);
        $this->assertSame($notification, $status->getNotifications()[0]);
        $this->assertSame($up, $status->getUp());
    }

    public function testSetters(): void
    {
        $status = $this->build();
        $up     = $this->serviceProvider()->create(SetUp::class, ['up' => 'up-3']);

        $status->setPlataform('plat-2');
        $status->setErrors([]);
        $status->setNotifications([]);
        $status->setPartnerStatus('status-2');
        $newDate = $status->getLastModifiedDt();
        $status->setLastModifiedDt($newDate);
        $status->setStatus(PlatformIntegrationStatusEnum::fromValue('PENDING'));
        $status->setEventId('event-2');
        $status->setPlatform('platform-2');
        $status->setUp($up);

        $this->assertSame('plat-2', $status->getPlataform());
        $this->assertSame([], $status->getErrors());
        $this->assertSame([], $status->getNotifications());
        $this->assertSame('status-2', $status->getPartnerStatus());
        $this->assertSame('event-2', $status->getEventId());
        $this->assertSame('platform-2', $status->getPlatform());
        $this->assertSame($up, $status->getUp());
    }
}
