<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Tag;

use Gubee\SDK\Model\Tag\PackageErrorApi;
use PHPUnit\Framework\TestCase;

class PackageErrorApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $error = new PackageErrorApi('order-1', 'Error message', 'Description', ['foo' => 'bar']);

        $this->assertSame('order-1', $error->getOrderId());
        $this->assertSame('Error message', $error->getMessage());
        $this->assertSame('Description', $error->getMessageDescription());
        $this->assertSame(['foo' => 'bar'], $error->getParameters());
    }

    public function testSetters(): void
    {
        $error = new PackageErrorApi('order-1');

        $error->setOrderId('order-2');
        $error->setMessage('msg');
        $error->setMessageDescription('desc');
        $error->setParameters(['a' => 1]);

        $this->assertSame('order-2', $error->getOrderId());
        $this->assertSame('msg', $error->getMessage());
        $this->assertSame('desc', $error->getMessageDescription());
        $this->assertSame(['a' => 1], $error->getParameters());
    }

    public function testDefaultsAreNull(): void
    {
        $error = new PackageErrorApi('order-1');

        $this->assertNull($error->getMessage());
        $this->assertNull($error->getMessageDescription());
        $this->assertNull($error->getParameters());
    }
}
