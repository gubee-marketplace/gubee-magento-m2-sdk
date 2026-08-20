<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\AttributeFilterParams;
use PHPUnit\Framework\TestCase;

class AttributeFilterParamsTest extends TestCase
{
    public function testConstructor(): void
    {
        $params = new AttributeFilterParams('attr-1', 'val-1');

        $this->assertSame('attr-1', $params->getAttributeId());
        $this->assertSame('val-1', $params->getAttributeValue());
    }

    public function testConstructorDefaults(): void
    {
        $params = new AttributeFilterParams();

        $this->assertNull($params->getAttributeId());
        $this->assertNull($params->getAttributeValue());
    }

    public function testSetters(): void
    {
        $params = new AttributeFilterParams();

        $params->setAttributeId('attr-2');
        $params->setAttributeValue('val-2');

        $this->assertSame('attr-2', $params->getAttributeId());
        $this->assertSame('val-2', $params->getAttributeValue());
    }
}
