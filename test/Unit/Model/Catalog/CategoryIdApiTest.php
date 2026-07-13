<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog;

use Gubee\SDK\Model\Catalog\CategoryIdApi;
use PHPUnit\Framework\TestCase;

class CategoryIdApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $category = new CategoryIdApi('id-1', 'hubee-1');

        $this->assertSame('id-1', $category->getId());
        $this->assertSame('hubee-1', $category->getHubeeId());
    }

    public function testSetters(): void
    {
        $category = new CategoryIdApi();

        $category->setId('id-2');
        $category->setHubeeId('hubee-2');

        $this->assertSame('id-2', $category->getId());
        $this->assertSame('hubee-2', $category->getHubeeId());
    }

    public function testDefaultsAreNull(): void
    {
        $category = new CategoryIdApi();

        $this->assertNull($category->getId());
        $this->assertNull($category->getHubeeId());
    }
}
