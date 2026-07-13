<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Enum\Common\PhoneTypeEnum;
use Gubee\SDK\Model\Common\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testConstructorWithStringType(): void
    {
        $phone = new Phone(11, '999999999', 'CELLPHONE', '011', 'ext-1', true);

        $this->assertSame(11, $phone->getDdd());
        $this->assertSame('999999999', $phone->getNumber());
        $this->assertInstanceOf(PhoneTypeEnum::class, $phone->getType());
        $this->assertSame('CELLPHONE', (string) $phone->getType());
        $this->assertSame('011', $phone->getAreaCode());
        $this->assertSame('ext-1', $phone->getExtension());
        $this->assertTrue($phone->getVerified());
    }

    public function testConstructorWithEnumInstance(): void
    {
        $phone = new Phone(11, '999999999', PhoneTypeEnum::HOME());

        $this->assertSame('HOME', (string) $phone->getType());
    }

    public function testConstructorWithDefaults(): void
    {
        $phone = new Phone();

        $this->assertNull($phone->getDdd());
        $this->assertNull($phone->getNumber());
        $this->assertNull($phone->getType());
        $this->assertNull($phone->getAreaCode());
        $this->assertNull($phone->getExtension());
        $this->assertNull($phone->getVerified());
    }

    public function testSetters(): void
    {
        $phone = new Phone();

        $phone->setDdd(21);
        $phone->setNumber('888888888');
        $phone->setType(PhoneTypeEnum::COMMERCIAL());
        $phone->setAreaCode('021');
        $phone->setExtension('ext-2');
        $phone->setVerified(false);

        $this->assertSame(21, $phone->getDdd());
        $this->assertSame('888888888', $phone->getNumber());
        $this->assertSame('COMMERCIAL', (string) $phone->getType());
        $this->assertSame('021', $phone->getAreaCode());
        $this->assertSame('ext-2', $phone->getExtension());
        $this->assertFalse($phone->getVerified());
    }
}
