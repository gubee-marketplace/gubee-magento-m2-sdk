<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Enum\Catalog\Product\DomainEnum;
use Gubee\SDK\Model\Catalog\Product\ValidateProductMessageApi;
use PHPUnit\Framework\TestCase;

class ValidateProductMessageApiTest extends TestCase
{
    private function build(): ValidateProductMessageApi
    {
        return new ValidateProductMessageApi('domainId-1', 'BRAND', 'code-1', 'msg-1');
    }

    public function testConstructorCoercesEnum(): void
    {
        $api = $this->build();

        $this->assertSame('domainId-1', $api->getDomainId());
        $this->assertEquals(DomainEnum::fromValue('BRAND'), $api->getDomain());
        $this->assertSame('code-1', $api->getCode());
        $this->assertSame('msg-1', $api->getValidationMessage());
    }

    public function testConstructorAcceptsEnumInstance(): void
    {
        $api = new ValidateProductMessageApi(domain: DomainEnum::fromValue('BRAND'));

        $this->assertEquals(DomainEnum::fromValue('BRAND'), $api->getDomain());
    }

    public function testConstructorDefaults(): void
    {
        $api = new ValidateProductMessageApi();

        $this->assertNull($api->getDomainId());
        $this->assertNull($api->getDomain());
        $this->assertNull($api->getCode());
        $this->assertNull($api->getValidationMessage());
    }

    public function testSetters(): void
    {
        $api = $this->build();

        $api->setDomainId('domainId-2');
        $api->setDomain(DomainEnum::fromValue('BRAND'));
        $api->setCode('code-2');
        $api->setValidationMessage('msg-2');

        $this->assertSame('domainId-2', $api->getDomainId());
        $this->assertSame('code-2', $api->getCode());
        $this->assertSame('msg-2', $api->getValidationMessage());
    }
}
