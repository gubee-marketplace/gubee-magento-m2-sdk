<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Notification;

use Gubee\SDK\Enum\Notification\NotificationTypeEnum;
use Gubee\SDK\Model\Notification\IntegrationNotification;
use PHPUnit\Framework\TestCase;

class IntegrationNotificationTest extends TestCase
{
    public function testConstructorWithAllFieldsPopulated(): void
    {
        $notification = new IntegrationNotification(
            'source-1',
            'plataform-1',
            'type-1',
            'message-1',
            'reason-1',
            true,
            'WARNING'
        );

        $this->assertSame('source-1', $notification->getSourceId());
        $this->assertSame('plataform-1', $notification->getPlataform());
        $this->assertSame('type-1', $notification->getType());
        $this->assertSame('message-1', $notification->getMessage());
        $this->assertSame('reason-1', $notification->getReason());
        $this->assertTrue($notification->getKeyMessage());
        $this->assertInstanceOf(NotificationTypeEnum::class, $notification->getNotificationType());
        $this->assertSame('WARNING', (string) $notification->getNotificationType());
    }

    public function testConstructorAcceptsEnumInstanceForNotificationType(): void
    {
        $enum         = NotificationTypeEnum::ERROR();
        $notification = new IntegrationNotification(notificationType: $enum);

        $this->assertSame($enum, $notification->getNotificationType());
    }

    public function testConstructorDefaultsAreNull(): void
    {
        $notification = new IntegrationNotification();

        $this->assertNull($notification->getSourceId());
        $this->assertNull($notification->getPlataform());
        $this->assertNull($notification->getType());
        $this->assertNull($notification->getMessage());
        $this->assertNull($notification->getReason());
        $this->assertNull($notification->getKeyMessage());
        $this->assertNull($notification->getNotificationType());
    }

    public function testSetters(): void
    {
        $notification = new IntegrationNotification();

        $notification->setSourceId('source-2');
        $notification->setPlataform('plataform-2');
        $notification->setType('type-2');
        $notification->setMessage('message-2');
        $notification->setReason('reason-2');
        $notification->setKeyMessage(false);
        $notification->setNotificationType(NotificationTypeEnum::INFO());

        $this->assertSame('source-2', $notification->getSourceId());
        $this->assertSame('plataform-2', $notification->getPlataform());
        $this->assertSame('type-2', $notification->getType());
        $this->assertSame('message-2', $notification->getMessage());
        $this->assertSame('reason-2', $notification->getReason());
        $this->assertFalse($notification->getKeyMessage());
        $this->assertSame('INFO', (string) $notification->getNotificationType());
    }
}
