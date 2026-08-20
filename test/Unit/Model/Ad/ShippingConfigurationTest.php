<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Model\Ad\ShippingConfiguration;
use PHPUnit\Framework\TestCase;

class ShippingConfigurationTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $configuration = new ShippingConfiguration('key-1', 'value-1');

        $this->assertSame('key-1', $configuration->getKey());
        $this->assertSame('value-1', $configuration->getValue());
    }

    public function testSetters(): void
    {
        $configuration = new ShippingConfiguration('key-1', 'value-1');

        $configuration->setKey('key-2');
        $configuration->setValue('value-2');

        $this->assertSame('key-2', $configuration->getKey());
        $this->assertSame('value-2', $configuration->getValue());
    }
}
