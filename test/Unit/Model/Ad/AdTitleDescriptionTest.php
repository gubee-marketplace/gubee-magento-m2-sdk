<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Model\Ad\AdTitleDescription;
use PHPUnit\Framework\TestCase;

class AdTitleDescriptionTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $model = new AdTitleDescription('Title', 'Description');

        $this->assertSame('Title', $model->getTitle());
        $this->assertSame('Description', $model->getDescription());
    }

    public function testSetters(): void
    {
        $model = new AdTitleDescription();

        $model->setTitle('New Title');
        $model->setDescription('New Description');

        $this->assertSame('New Title', $model->getTitle());
        $this->assertSame('New Description', $model->getDescription());
    }

    public function testDefaultsAreNull(): void
    {
        $model = new AdTitleDescription();

        $this->assertNull($model->getTitle());
        $this->assertNull($model->getDescription());
    }
}
