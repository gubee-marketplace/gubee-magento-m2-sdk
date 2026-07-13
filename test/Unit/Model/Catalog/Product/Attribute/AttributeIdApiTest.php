<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeIdApi;
use PHPUnit\Framework\TestCase;

class AttributeIdApiTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $attributeIdApi = new AttributeIdApi('id-1', 'hubee-1');

        $this->assertSame('id-1', $attributeIdApi->getId());
        $this->assertSame('hubee-1', $attributeIdApi->getHubeeId());
    }

    public function testConstructWithNoFields(): void
    {
        $attributeIdApi = new AttributeIdApi();

        $this->assertNull($attributeIdApi->getId());
        $this->assertNull($attributeIdApi->getHubeeId());
    }

    public function testSetters(): void
    {
        $attributeIdApi = new AttributeIdApi();

        $attributeIdApi->setId('id-2');
        $attributeIdApi->setHubeeId('hubee-2');

        $this->assertSame('id-2', $attributeIdApi->getId());
        $this->assertSame('hubee-2', $attributeIdApi->getHubeeId());
    }
}
