<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Ad\AdShippingMode;
use Gubee\SDK\Model\Ad\ShippingConfiguration;
use PHPUnit\Framework\TestCase;

class AdShippingModeTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesConfigurationsFromRawArrays(): void
    {
        $mode = new AdShippingMode(
            $this->serviceProvider(),
            'id-1',
            'Mode',
            ['opt-1'],
            [['key' => 'k', 'value' => 'v']]
        );

        $this->assertSame('id-1', $mode->getId());
        $this->assertSame('Mode', $mode->getName());
        $this->assertSame(['opt-1'], $mode->getOptions());
        $this->assertContainsOnlyInstancesOf(ShippingConfiguration::class, $mode->getConfigurations());
    }

    public function testPassesThroughAlreadyHydratedInstance(): void
    {
        $config = new ShippingConfiguration('k', 'v');

        $mode = new AdShippingMode($this->serviceProvider(), 'id-1', null, [], [$config]);

        $this->assertSame($config, $mode->getConfigurations()[0]);
    }

    public function testSetters(): void
    {
        $mode = new AdShippingMode($this->serviceProvider(), 'id-1', null, []);

        $mode->setId('id-2');
        $mode->setName('New Mode');
        $mode->setOptions(['opt-2']);
        $config = new ShippingConfiguration('k2', 'v2');
        $mode->setConfigurations([$config]);

        $this->assertSame('id-2', $mode->getId());
        $this->assertSame('New Mode', $mode->getName());
        $this->assertSame(['opt-2'], $mode->getOptions());
        $this->assertSame([$config], $mode->getConfigurations());
    }

    public function testDefaultsAreNull(): void
    {
        $mode = new AdShippingMode($this->serviceProvider(), 'id-1', null, []);

        $this->assertNull($mode->getName());
        $this->assertNull($mode->getConfigurations());
    }
}
