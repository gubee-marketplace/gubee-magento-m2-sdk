<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Sales\Order\Carrier;
use PHPUnit\Framework\TestCase;

class CarrierTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): Carrier
    {
        return $this->serviceProvider()->create(
            Carrier::class,
            $overrides + [
                'cpfCnpj'           => '11111111000191',
                'name'              => 'Carrier Co',
                'stateRegistration' => 'sr-1',
                'address'           => ['street' => 'Main St'],
            ]
        );
    }

    public function testHydratesAddressFromRawArray(): void
    {
        $carrier = $this->build();

        $this->assertSame('11111111000191', $carrier->getCpfCnpj());
        $this->assertSame('Carrier Co', $carrier->getName());
        $this->assertSame('sr-1', $carrier->getStateRegistration());
        $this->assertInstanceOf(Address::class, $carrier->getAddress());
        $this->assertSame('Main St', $carrier->getAddress()->getStreet());
    }

    public function testPassesThroughAlreadyHydratedAddress(): void
    {
        $address = $this->serviceProvider()->create(Address::class, ['street' => 'Other St']);

        $carrier = $this->build(['address' => $address]);

        $this->assertSame($address, $carrier->getAddress());
    }

    public function testSetters(): void
    {
        $carrier = $this->build();
        $address = $this->serviceProvider()->create(Address::class, ['street' => 'New St']);

        $carrier->setCpfCnpj('22222222000191');
        $carrier->setName('New Carrier');
        $carrier->setStateRegistration('sr-2');
        $carrier->setAddress($address);

        $this->assertSame('22222222000191', $carrier->getCpfCnpj());
        $this->assertSame('New Carrier', $carrier->getName());
        $this->assertSame('sr-2', $carrier->getStateRegistration());
        $this->assertSame($address, $carrier->getAddress());
    }
}
