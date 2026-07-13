<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Notification;

use Gubee\SDK\Model\Notification\NotificationResponseApi;
use PHPUnit\Framework\TestCase;

class NotificationResponseApiTest extends TestCase
{
    public function testConstructorWithAllFieldsPopulated(): void
    {
        $response = new NotificationResponseApi(200, 'ok-body');

        $this->assertSame(200, $response->getHttpStatus());
        $this->assertSame('ok-body', $response->getBody());
    }

    public function testConstructorDefaultsAreNull(): void
    {
        $response = new NotificationResponseApi();

        $this->assertNull($response->getHttpStatus());
        $this->assertNull($response->getBody());
    }

    public function testSetters(): void
    {
        $response = new NotificationResponseApi();

        $response->setHttpStatus(500);
        $response->setBody('error-body');

        $this->assertSame(500, $response->getHttpStatus());
        $this->assertSame('error-body', $response->getBody());
    }
}
