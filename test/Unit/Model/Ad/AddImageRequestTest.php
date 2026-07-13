<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Model\Ad\AddImageRequest;
use PHPUnit\Framework\TestCase;

class AddImageRequestTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $request = new AddImageRequest('seller-1', 'https://x/img.png', 'uuid-1', 'image', 1, true, false);

        $this->assertSame('seller-1', $request->getSellerId());
        $this->assertSame('https://x/img.png', $request->getUrl());
        $this->assertSame('uuid-1', $request->getUuid());
        $this->assertSame('image', $request->getName());
        $this->assertSame(1, $request->getOrder());
        $this->assertTrue($request->getMain());
        $this->assertFalse($request->getImportedByApi());
    }

    public function testSetters(): void
    {
        $request = new AddImageRequest();

        $request->setSellerId('seller-2');
        $request->setUrl('url-2');
        $request->setUuid('uuid-2');
        $request->setName('name-2');
        $request->setOrder(2);
        $request->setMain(false);
        $request->setImportedByApi(true);

        $this->assertSame('seller-2', $request->getSellerId());
        $this->assertSame('url-2', $request->getUrl());
        $this->assertSame('uuid-2', $request->getUuid());
        $this->assertSame('name-2', $request->getName());
        $this->assertSame(2, $request->getOrder());
        $this->assertFalse($request->getMain());
        $this->assertTrue($request->getImportedByApi());
    }

    public function testDefaultsAreNull(): void
    {
        $request = new AddImageRequest();

        $this->assertNull($request->getSellerId());
        $this->assertNull($request->getUrl());
        $this->assertNull($request->getUuid());
        $this->assertNull($request->getName());
        $this->assertNull($request->getOrder());
        $this->assertNull($request->getMain());
        $this->assertNull($request->getImportedByApi());
    }
}
