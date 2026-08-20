<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Tag;

use Gubee\SDK\Model\Tag\PackApi;
use PHPUnit\Framework\TestCase;

class PackApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $pack = new PackApi('https://example.com/pack.pdf', 'PDF');

        $this->assertSame('https://example.com/pack.pdf', $pack->getLink());
        $this->assertSame('PDF', $pack->getType());
    }

    public function testSetters(): void
    {
        $pack = new PackApi('link', 'PDF');

        $pack->setLink('other-link');
        $pack->setType('ZPL');

        $this->assertSame('other-link', $pack->getLink());
        $this->assertSame('ZPL', $pack->getType());
    }
}
