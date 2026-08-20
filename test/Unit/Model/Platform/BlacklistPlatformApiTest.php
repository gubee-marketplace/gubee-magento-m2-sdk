<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Model\Platform\BlacklistPlatformApi;
use PHPUnit\Framework\TestCase;

class BlacklistPlatformApiTest extends TestCase
{
    public function testConstructorWithAllFieldsPopulated(): void
    {
        $blacklist = new BlacklistPlatformApi('platform-1', 'ACTIVE');

        $this->assertSame('platform-1', $blacklist->getName());
        $this->assertSame('ACTIVE', $blacklist->getStatus());
    }

    public function testSetters(): void
    {
        $blacklist = new BlacklistPlatformApi('platform-1', 'ACTIVE');

        $blacklist->setName('platform-2');
        $blacklist->setStatus('INACTIVE');

        $this->assertSame('platform-2', $blacklist->getName());
        $this->assertSame('INACTIVE', $blacklist->getStatus());
    }
}
