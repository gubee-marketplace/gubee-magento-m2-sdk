<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Tag;

use Gubee\SDK\Model\Tag\UngroupTagsResponseApi;
use PHPUnit\Framework\TestCase;

class UngroupTagsResponseApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $response = new UngroupTagsResponseApi('group-1', ['order-1'], 'message', ['a' => 1]);

        $this->assertSame('group-1', $response->getGroupId());
        $this->assertSame(['order-1'], $response->getUngroupedOrders());
        $this->assertSame('message', $response->getMessage());
        $this->assertSame(['a' => 1], $response->getParameters());
    }

    public function testSetters(): void
    {
        $response = new UngroupTagsResponseApi('group-1', []);

        $response->setGroupId('group-2');
        $response->setUngroupedOrders(['order-2']);
        $response->setMessage('msg');
        $response->setParameters(['b' => 2]);

        $this->assertSame('group-2', $response->getGroupId());
        $this->assertSame(['order-2'], $response->getUngroupedOrders());
        $this->assertSame('msg', $response->getMessage());
        $this->assertSame(['b' => 2], $response->getParameters());
    }

    public function testDefaultsAreNull(): void
    {
        $response = new UngroupTagsResponseApi('group-1', []);

        $this->assertNull($response->getMessage());
        $this->assertNull($response->getParameters());
    }
}
