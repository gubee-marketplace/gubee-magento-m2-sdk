<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Notification;

use Gubee\SDK\Model\Notification\NotificationRequestApi;
use PHPUnit\Framework\TestCase;

class NotificationRequestApiTest extends TestCase
{
    public function testConstructorWithAllFieldsPopulated(): void
    {
        $request = new NotificationRequestApi('https://example.com/webhook', 'payload-body');

        $this->assertSame('https://example.com/webhook', $request->getUrl());
        $this->assertSame('payload-body', $request->getBody());
    }

    public function testConstructorDefaultsBodyToNull(): void
    {
        $request = new NotificationRequestApi('https://example.com/webhook');

        $this->assertNull($request->getBody());
    }

    public function testSetters(): void
    {
        $request = new NotificationRequestApi('https://example.com/webhook');

        $request->setUrl('https://example.com/other');
        $request->setBody('new-body');

        $this->assertSame('https://example.com/other', $request->getUrl());
        $this->assertSame('new-body', $request->getBody());
    }
}
