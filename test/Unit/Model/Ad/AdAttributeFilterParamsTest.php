<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Model\Ad\AdAttributeFilterParams;
use PHPUnit\Framework\TestCase;

class AdAttributeFilterParamsTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $params = new AdAttributeFilterParams('color', 'red');

        $this->assertSame('color', $params->getAttributeName());
        $this->assertSame('red', $params->getAttributeValue());
    }

    public function testSetters(): void
    {
        $params = new AdAttributeFilterParams('color', 'red');

        $params->setAttributeName('size');
        $params->setAttributeValue('M');

        $this->assertSame('size', $params->getAttributeName());
        $this->assertSame('M', $params->getAttributeValue());
    }
}
