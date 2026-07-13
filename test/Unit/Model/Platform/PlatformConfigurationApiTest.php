<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Model\Platform\PlatformConfigurationApi;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PlatformConfigurationApiTest extends TestCase
{
    private function buildConfiguration(): PlatformConfigurationApi
    {
        return new PlatformConfigurationApi(
            'code-1',
            'label-1',
            'https://example.com/logo.png',
            'type-1',
            ['PUBLISH_A', 'PUBLISH_B'],
            ['NEW', 'PAID']
        );
    }

    public function testConstructorWithAllFieldsPopulated(): void
    {
        $configuration = $this->buildConfiguration();

        $this->assertSame('code-1', $configuration->getCode());
        $this->assertSame('label-1', $configuration->getLabel());
        $this->assertSame('https://example.com/logo.png', $configuration->getLogoUrl());
        $this->assertSame('type-1', $configuration->getType());
        $this->assertSame(['PUBLISH_A', 'PUBLISH_B'], $configuration->getPublishType());
        $this->assertSame(['NEW', 'PAID'], $configuration->getOrderStatus());
    }

    public function testConstructorDefaultsPublishTypeToNull(): void
    {
        $configuration = new PlatformConfigurationApi(
            'code-1',
            'label-1',
            'https://example.com/logo.png',
            'type-1',
            null,
            ['NEW']
        );

        $this->assertNull($configuration->getPublishType());
    }

    public function testSetters(): void
    {
        $configuration = $this->buildConfiguration();

        $configuration->setCode('code-2');
        $configuration->setLabel('label-2');
        $configuration->setLogoUrl('https://example.com/other.png');
        $configuration->setType('type-2');
        $configuration->setPublishType(['PUBLISH_C']);
        $configuration->setOrderStatus(['CANCELLED']);

        $this->assertSame('code-2', $configuration->getCode());
        $this->assertSame('label-2', $configuration->getLabel());
        $this->assertSame('https://example.com/other.png', $configuration->getLogoUrl());
        $this->assertSame('type-2', $configuration->getType());
        $this->assertSame(['PUBLISH_C'], $configuration->getPublishType());
        $this->assertSame(['CANCELLED'], $configuration->getOrderStatus());
    }

    public function testSetPublishTypeAcceptsNull(): void
    {
        $configuration = $this->buildConfiguration();

        $configuration->setPublishType(null);

        $this->assertNull($configuration->getPublishType());
    }

    public function testSetPublishTypeRejectsMismatchedTypes(): void
    {
        $configuration = $this->buildConfiguration();

        $this->expectException(InvalidArgumentException::class);
        $configuration->setPublishType([1, 2]);
    }
}
