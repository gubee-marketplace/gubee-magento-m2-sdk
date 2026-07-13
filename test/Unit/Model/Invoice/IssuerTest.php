<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Common\Phone;
use Gubee\SDK\Model\Invoice\Issuer;
use PHPUnit\Framework\TestCase;

class IssuerTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorHydratesRawAddressAndPhoneArrays(): void
    {
        $model = $this->serviceProvider()->create(
            Issuer::class,
            [
                'name'                  => 'Company',
                'fantasyName'           => 'Fantasy',
                'address'               => ['city' => 'Sao Paulo'],
                'cnpj'                  => '12345678000199',
                'phone'                 => ['ddd' => 11, 'number' => '999999999'],
                'stateRegistration'     => 'SR-1',
                'municipalRegistration' => 'MR-1',
            ]
        );

        $this->assertSame('Company', $model->getName());
        $this->assertSame('Fantasy', $model->getFantasyName());
        $this->assertInstanceOf(Address::class, $model->getAddress());
        $this->assertSame('Sao Paulo', $model->getAddress()->getCity());
        $this->assertSame('12345678000199', $model->getCnpj());
        $this->assertInstanceOf(Phone::class, $model->getPhone());
        $this->assertSame(11, $model->getPhone()->getDdd());
        $this->assertSame('SR-1', $model->getStateRegistration());
        $this->assertSame('MR-1', $model->getMunicipalRegistration());
    }

    public function testConstructorPassesThroughAlreadyHydratedAddressAndPhone(): void
    {
        $address = $this->serviceProvider()->create(Address::class, ['city' => 'Rio']);
        $phone   = $this->serviceProvider()->create(Phone::class, ['ddd' => 21]);

        $model = $this->serviceProvider()->create(
            Issuer::class,
            ['address' => $address, 'phone' => $phone]
        );

        $this->assertSame($address, $model->getAddress());
        $this->assertSame($phone, $model->getPhone());
    }

    public function testConstructorWithNullValues(): void
    {
        $model = $this->serviceProvider()->create(Issuer::class, []);

        $this->assertNull($model->getName());
        $this->assertNull($model->getFantasyName());
        $this->assertNull($model->getAddress());
        $this->assertNull($model->getCnpj());
        $this->assertNull($model->getPhone());
        $this->assertNull($model->getStateRegistration());
        $this->assertNull($model->getMunicipalRegistration());
    }

    public function testSettersAndGetters(): void
    {
        $model   = $this->serviceProvider()->create(Issuer::class, []);
        $address = $this->serviceProvider()->create(Address::class, ['city' => 'BH']);
        $phone   = $this->serviceProvider()->create(Phone::class, ['ddd' => 31]);

        $model->setName('N');
        $model->setFantasyName('F');
        $model->setAddress($address);
        $model->setCnpj('C');
        $model->setPhone($phone);
        $model->setStateRegistration('SR');
        $model->setMunicipalRegistration('MR');

        $this->assertSame('N', $model->getName());
        $this->assertSame('F', $model->getFantasyName());
        $this->assertSame($address, $model->getAddress());
        $this->assertSame('C', $model->getCnpj());
        $this->assertSame($phone, $model->getPhone());
        $this->assertSame('SR', $model->getStateRegistration());
        $this->assertSame('MR', $model->getMunicipalRegistration());
    }
}
