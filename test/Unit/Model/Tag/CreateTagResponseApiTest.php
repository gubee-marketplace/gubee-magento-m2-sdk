<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Tag;

use Gubee\SDK\Model\Tag\CreateTagResponseApi;
use PHPUnit\Framework\TestCase;

class CreateTagResponseApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $response = new CreateTagResponseApi('created');

        $this->assertSame('created', $response->getMessage());
    }

    public function testSetter(): void
    {
        $response = new CreateTagResponseApi();

        $response->setMessage('updated');

        $this->assertSame('updated', $response->getMessage());
    }

    public function testDefaultIsNull(): void
    {
        $response = new CreateTagResponseApi();

        $this->assertNull($response->getMessage());
    }
}
