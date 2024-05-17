<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Library\ObjectManager;

use Anonymous;
use DI\NotFoundException;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Client;
use PHPUnit\Framework\TestCase;

/**
 * @see \Gubee\SDK\Library\ObjectManager\ServiceProvider
 */
class ServiceProviderTest extends TestCase
{
    protected ServiceProviderInterface $container;

    public function setUp(): void
    {
        $this->container = container();
    }

    public function testCreate(): void
    {
        $client = $this->container->create(Client::class);
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testCreateNotRegistered(): void
    {
        $this->expectException(
            NotFoundException::class
        );
        // @phpstan-ignore-next-line
        $this->container->create(Anonymous::class);
    }
}
