<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Ad\OriginEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\OriginCountry;
use Gubee\SDK\Model\Catalog\Product\PatchProduct;
use PHPUnit\Framework\TestCase;

class PatchProductTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): PatchProduct
    {
        return $this->serviceProvider()->create(
            PatchProduct::class,
            $overrides + [
                'sellerId'           => 'seller-1',
                'name'               => 'name-1',
                'nbm'                => 'nbm-1',
                'origin'             => 'NATIONAL',
                'originCountry'      => ['name' => 'Brazil', 'alpha2Code' => 'BR'],
                'disableIntegration' => true,
            ]
        );
    }

    public function testHydratesOriginCountryFromRawArray(): void
    {
        $product = $this->build();

        $this->assertSame('seller-1', $product->getSellerId());
        $this->assertSame('name-1', $product->getName());
        $this->assertSame('nbm-1', $product->getNbm());
        $this->assertEquals(OriginEnum::fromValue('NATIONAL'), $product->getOrigin());
        $this->assertInstanceOf(OriginCountry::class, $product->getOriginCountry());
        $this->assertSame('Brazil', $product->getOriginCountry()->getName());
        $this->assertTrue($product->getDisableIntegration());
    }

    public function testPassesThroughAlreadyHydratedOriginCountry(): void
    {
        $originCountry = $this->serviceProvider()->create(OriginCountry::class, ['name' => 'Argentina']);

        $product = $this->build(['originCountry' => $originCountry]);

        $this->assertSame($originCountry, $product->getOriginCountry());
    }

    public function testSetters(): void
    {
        $product       = $this->build();
        $originCountry = $this->serviceProvider()->create(OriginCountry::class, ['name' => 'Chile']);

        $product->setSellerId('seller-2');
        $product->setName('name-2');
        $product->setNbm('nbm-2');
        $product->setOrigin(OriginEnum::fromValue('NATIONAL'));
        $product->setOriginCountry($originCountry);
        $product->setDisableIntegration(false);

        $this->assertSame('seller-2', $product->getSellerId());
        $this->assertSame('name-2', $product->getName());
        $this->assertSame('nbm-2', $product->getNbm());
        $this->assertSame($originCountry, $product->getOriginCountry());
        $this->assertFalse($product->getDisableIntegration());
    }
}
