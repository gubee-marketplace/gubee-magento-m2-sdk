<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Enum\Ad\AssociateTypeEnum;
use Gubee\SDK\Model\Ad\AssociateAd;
use PHPUnit\Framework\TestCase;

class AssociateAdTest extends TestCase
{
    public function testConstructorWithAllFields(): void
    {
        $ad = new AssociateAd(
            'id-1',
            10,
            'VARIANT',
            'https://example.com/img.png',
            ['tag-1', 'tag-2'],
            'sku-1'
        );

        $this->assertSame('id-1', $ad->getId());
        $this->assertSame(10, $ad->getQty());
        $this->assertInstanceOf(AssociateTypeEnum::class, $ad->getType());
        $this->assertSame('VARIANT', (string) $ad->getType());
        $this->assertSame('https://example.com/img.png', $ad->getMainImg());
        $this->assertSame(['tag-1', 'tag-2'], $ad->getTags());
        $this->assertSame('sku-1', $ad->getSku());
    }

    public function testConstructorWithEnumInstanceAndDefaults(): void
    {
        $ad = new AssociateAd('id-2', null, AssociateTypeEnum::KIT());

        $this->assertSame('id-2', $ad->getId());
        $this->assertNull($ad->getQty());
        $this->assertSame('KIT', (string) $ad->getType());
        $this->assertNull($ad->getMainImg());
        $this->assertNull($ad->getTags());
        $this->assertNull($ad->getSku());
    }

    public function testSetters(): void
    {
        $ad = new AssociateAd('id-1', null, 'VARIANT');

        $ad->setId('id-3');
        $ad->setQty(5);
        $ad->setType(AssociateTypeEnum::KIT());
        $ad->setMainImg('img');
        $ad->setTags(['a']);
        $ad->setSku('sku');

        $this->assertSame('id-3', $ad->getId());
        $this->assertSame(5, $ad->getQty());
        $this->assertSame('KIT', (string) $ad->getType());
        $this->assertSame('img', $ad->getMainImg());
        $this->assertSame(['a'], $ad->getTags());
        $this->assertSame('sku', $ad->getSku());
    }

    public function testSetTagsAcceptsNull(): void
    {
        $ad = new AssociateAd('id-1', null, 'VARIANT', null, ['a']);

        $ad->setTags(null);

        $this->assertNull($ad->getTags());
    }
}
