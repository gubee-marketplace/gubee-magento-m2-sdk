<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Model\Common\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testConstructorWithAllFields(): void
    {
        $address = new Address(
            'name-1',
            'street-1',
            '123',
            'apt 1',
            'near park',
            'neighborhood-1',
            'city-1',
            'region-1',
            'country-1',
            '00000-000',
            'state-1'
        );

        $this->assertSame('name-1', $address->getName());
        $this->assertSame('street-1', $address->getStreet());
        $this->assertSame('123', $address->getNumber());
        $this->assertSame('apt 1', $address->getComplement());
        $this->assertSame('near park', $address->getReference());
        $this->assertSame('neighborhood-1', $address->getNeighborhood());
        $this->assertSame('city-1', $address->getCity());
        $this->assertSame('region-1', $address->getRegion());
        $this->assertSame('country-1', $address->getCountry());
        $this->assertSame('00000-000', $address->getPostCode());
        $this->assertSame('state-1', $address->getState());
    }

    public function testConstructorWithDefaults(): void
    {
        $address = new Address();

        $this->assertNull($address->getName());
        $this->assertNull($address->getStreet());
        $this->assertNull($address->getNumber());
        $this->assertNull($address->getComplement());
        $this->assertNull($address->getReference());
        $this->assertNull($address->getNeighborhood());
        $this->assertNull($address->getCity());
        $this->assertNull($address->getRegion());
        $this->assertNull($address->getCountry());
        $this->assertNull($address->getPostCode());
        $this->assertNull($address->getState());
    }

    public function testSetters(): void
    {
        $address = new Address();

        $address->setName('name-2');
        $address->setStreet('street-2');
        $address->setNumber('124');
        $address->setComplement('apt 2');
        $address->setReference('near mall');
        $address->setNeighborhood('neighborhood-2');
        $address->setCity('city-2');
        $address->setRegion('region-2');
        $address->setCountry('country-2');
        $address->setPostCode('11111-111');
        $address->setState('state-2');

        $this->assertSame('name-2', $address->getName());
        $this->assertSame('street-2', $address->getStreet());
        $this->assertSame('124', $address->getNumber());
        $this->assertSame('apt 2', $address->getComplement());
        $this->assertSame('near mall', $address->getReference());
        $this->assertSame('neighborhood-2', $address->getNeighborhood());
        $this->assertSame('city-2', $address->getCity());
        $this->assertSame('region-2', $address->getRegion());
        $this->assertSame('country-2', $address->getCountry());
        $this->assertSame('11111-111', $address->getPostCode());
        $this->assertSame('state-2', $address->getState());
    }
}
