<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Model\Invoice\RegistrationNumberApi;
use PHPUnit\Framework\TestCase;

class RegistrationNumberApiTest extends TestCase
{
    public function testConstructorSetsAllFields(): void
    {
        $model = new RegistrationNumberApi('CNPJ', '12345678000199');

        $this->assertSame('CNPJ', $model->getName());
        $this->assertSame('12345678000199', $model->getRegistrationNumber());
    }

    public function testConstructorWithNullValues(): void
    {
        $model = new RegistrationNumberApi();

        $this->assertNull($model->getName());
        $this->assertNull($model->getRegistrationNumber());
    }

    public function testSettersAndGetters(): void
    {
        $model = new RegistrationNumberApi();

        $model->setName('CPF');
        $model->setRegistrationNumber('12345678900');

        $this->assertSame('CPF', $model->getName());
        $this->assertSame('12345678900', $model->getRegistrationNumber());
    }
}
