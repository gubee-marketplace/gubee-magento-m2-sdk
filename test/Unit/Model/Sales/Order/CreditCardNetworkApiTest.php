<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\CreditCardNetworkApi;
use PHPUnit\Framework\TestCase;

class CreditCardNetworkApiTest extends TestCase
{
    public function testConstructor(): void
    {
        $api = new CreditCardNetworkApi('code-1', 'name-1');

        $this->assertSame('code-1', $api->getCode());
        $this->assertSame('name-1', $api->getName());
    }

    public function testConstructorDefaults(): void
    {
        $api = new CreditCardNetworkApi();

        $this->assertNull($api->getCode());
        $this->assertNull($api->getName());
    }

    public function testSetters(): void
    {
        $api = new CreditCardNetworkApi();

        $api->setCode('code-2');
        $api->setName('name-2');

        $this->assertSame('code-2', $api->getCode());
        $this->assertSame('name-2', $api->getName());
    }
}
