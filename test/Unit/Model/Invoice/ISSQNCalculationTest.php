<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Model\Invoice\ISSQNCalculation;
use PHPUnit\Framework\TestCase;

class ISSQNCalculationTest extends TestCase
{
    private function build(): ISSQNCalculation
    {
        return new ISSQNCalculation('12345', 100.0, 90.0, 4.5);
    }

    public function testConstructorSetsAllFields(): void
    {
        $model = $this->build();

        $this->assertSame('12345', $model->getMunicipalRegistration());
        $this->assertSame(100.0, $model->getTotalServiceValue());
        $this->assertSame(90.0, $model->getIssqnCalculationBase());
        $this->assertSame(4.5, $model->getIssqnValue());
    }

    public function testConstructorWithNullValues(): void
    {
        $model = new ISSQNCalculation();

        $this->assertNull($model->getMunicipalRegistration());
        $this->assertNull($model->getTotalServiceValue());
        $this->assertNull($model->getIssqnCalculationBase());
        $this->assertNull($model->getIssqnValue());
    }

    public function testSettersAndGetters(): void
    {
        $model = new ISSQNCalculation();

        $model->setMunicipalRegistration('999');
        $model->setTotalServiceValue(50.5);
        $model->setIssqnCalculationBase(40.0);
        $model->setIssqnValue(2.0);

        $this->assertSame('999', $model->getMunicipalRegistration());
        $this->assertSame(50.5, $model->getTotalServiceValue());
        $this->assertSame(40.0, $model->getIssqnCalculationBase());
        $this->assertSame(2.0, $model->getIssqnValue());
    }
}
