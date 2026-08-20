<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Model\Common\Link;
use PHPUnit\Framework\TestCase;

class LinkTest extends TestCase
{
    public function testConstructorWithAllFields(): void
    {
        $link = new Link(
            'https://example.com',
            'en',
            'title-1',
            'type-1',
            'deprecation-1',
            'profile-1',
            'name-1',
            true
        );

        $this->assertSame('https://example.com', $link->getHref());
        $this->assertSame('en', $link->getHreflang());
        $this->assertSame('title-1', $link->getTitle());
        $this->assertSame('type-1', $link->getType());
        $this->assertSame('deprecation-1', $link->getDeprecation());
        $this->assertSame('profile-1', $link->getProfile());
        $this->assertSame('name-1', $link->getName());
        $this->assertTrue($link->getTemplated());
    }

    public function testConstructorWithDefaults(): void
    {
        $link = new Link();

        $this->assertNull($link->getHref());
        $this->assertNull($link->getHreflang());
        $this->assertNull($link->getTitle());
        $this->assertNull($link->getType());
        $this->assertNull($link->getDeprecation());
        $this->assertNull($link->getProfile());
        $this->assertNull($link->getName());
        $this->assertNull($link->getTemplated());
    }

    public function testSetters(): void
    {
        $link = new Link();

        $link->setHref('https://example.com/2');
        $link->setHreflang('pt');
        $link->setTitle('title-2');
        $link->setType('type-2');
        $link->setDeprecation('deprecation-2');
        $link->setProfile('profile-2');
        $link->setName('name-2');
        $link->setTemplated(false);

        $this->assertSame('https://example.com/2', $link->getHref());
        $this->assertSame('pt', $link->getHreflang());
        $this->assertSame('title-2', $link->getTitle());
        $this->assertSame('type-2', $link->getType());
        $this->assertSame('deprecation-2', $link->getDeprecation());
        $this->assertSame('profile-2', $link->getProfile());
        $this->assertSame('name-2', $link->getName());
        $this->assertFalse($link->getTemplated());
    }
}
