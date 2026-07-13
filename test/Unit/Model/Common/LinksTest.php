<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Model\Common\Links;
use PHPUnit\Framework\TestCase;

class LinksTest extends TestCase
{
    public function testConstructorInstantiates(): void
    {
        $links = new Links();

        $this->assertInstanceOf(Links::class, $links);
        $this->assertSame([], $links->jsonSerialize());
    }
}
