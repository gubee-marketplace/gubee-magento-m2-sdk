<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\Catalog\Product\Attribute\OriginCountry;
use PHPUnit\Framework\TestCase;

class OriginCountryTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $originCountry = new OriginCountry('Brazil', 'BR', 'BRA');

        $this->assertSame('Brazil', $originCountry->getName());
        $this->assertSame('BR', $originCountry->getAlpha2Code());
        $this->assertSame('BRA', $originCountry->getAlpha3Code());
    }

    public function testConstructWithNoFields(): void
    {
        $originCountry = new OriginCountry();

        $this->assertNull($originCountry->getName());
        $this->assertNull($originCountry->getAlpha2Code());
        $this->assertNull($originCountry->getAlpha3Code());
    }

    public function testSetters(): void
    {
        $originCountry = new OriginCountry();

        $originCountry->setName('Brazil');
        $originCountry->setAlpha2Code('BR');
        $originCountry->setAlpha3Code('BRA');

        $this->assertSame('Brazil', $originCountry->getName());
        $this->assertSame('BR', $originCountry->getAlpha2Code());
        $this->assertSame('BRA', $originCountry->getAlpha3Code());
    }
}
