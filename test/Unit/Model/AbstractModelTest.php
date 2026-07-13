<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class AbstractModelTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function hydrator(): AbstractModel
    {
        return new class extends AbstractModel {
            /** @param array<string, mixed> $data @param array<string, mixed> $typeMap @return array<string, mixed> */
            public function callHydrate(ServiceProviderInterface $serviceProvider, array $data, array $typeMap): array
            {
                return $this->hydrate($serviceProvider, $data, $typeMap);
            }
        };
    }

    public function testHydratesSingleNestedModelFromArray(): void
    {
        $result = $this->hydrator()->callHydrate(
            $this->serviceProvider(),
            ['stub' => ['sku' => 'ABC']],
            ['stub' => HydrationStub::class]
        );

        $this->assertInstanceOf(HydrationStub::class, $result['stub']);
        $this->assertSame('ABC', $result['stub']->sku);
    }

    public function testPassesThroughAlreadyHydratedInstance(): void
    {
        $instance = new HydrationStub('XYZ');

        $result = $this->hydrator()->callHydrate(
            $this->serviceProvider(),
            ['stub' => $instance],
            ['stub' => HydrationStub::class]
        );

        $this->assertSame($instance, $result['stub']);
    }

    public function testLeavesNullValueAsNull(): void
    {
        $result = $this->hydrator()->callHydrate(
            $this->serviceProvider(),
            ['stub' => null],
            ['stub' => HydrationStub::class]
        );

        $this->assertNull($result['stub']);
    }

    public function testHydratesArrayOfNestedModels(): void
    {
        $result = $this->hydrator()->callHydrate(
            $this->serviceProvider(),
            ['stubs' => [['sku' => 'A'], ['sku' => 'B']]],
            ['stubs' => [HydrationStub::class]]
        );

        $this->assertContainsOnlyInstancesOf(HydrationStub::class, $result['stubs']);
        $this->assertSame('A', $result['stubs'][0]->sku);
        $this->assertSame('B', $result['stubs'][1]->sku);
    }

    public function testHydratesArrayMixingRawAndAlreadyHydratedElements(): void
    {
        $already = new HydrationStub('KEEP');

        $result = $this->hydrator()->callHydrate(
            $this->serviceProvider(),
            ['stubs' => ['first' => $already, 'second' => ['sku' => 'NEW']]],
            ['stubs' => [HydrationStub::class]]
        );

        $this->assertSame($already, $result['stubs']['first']);
        $this->assertInstanceOf(HydrationStub::class, $result['stubs']['second']);
        $this->assertSame('NEW', $result['stubs']['second']->sku);
    }

    public function testJsonSerializeFiltersOutNullProperties(): void
    {
        $model = new class extends AbstractModel {
            public ?string $keep = 'value';
            public ?string $drop = null;
        };

        $this->assertSame(['keep' => 'value'], $model->jsonSerialize());
    }

    private function validator(): AbstractModel
    {
        return new class extends AbstractModel {
            /** @param array<int|string, mixed> $array */
            public function callValidate(array $array, string $type): bool
            {
                return $this->validateArrayElements($array, $type);
            }
        };
    }

    public function testValidateArrayElementsAcceptsMatchingTypes(): void
    {
        $this->assertTrue($this->validator()->callValidate(['a', 'b'], 'string'));
        $this->assertTrue($this->validator()->callValidate([1, 2], 'int'));
        $this->assertTrue($this->validator()->callValidate([1.0, 2.0], 'float'));
        $this->assertTrue($this->validator()->callValidate([true, false], 'bool'));
        $this->assertTrue($this->validator()->callValidate([new HydrationStub('A')], HydrationStub::class));
    }

    public function testValidateArrayElementsRejectsMismatchedString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->validator()->callValidate([1], 'string');
    }

    public function testValidateArrayElementsRejectsMismatchedInt(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->validator()->callValidate(['a'], 'int');
    }

    public function testValidateArrayElementsRejectsMismatchedFloat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->validator()->callValidate(['a'], 'float');
    }

    public function testValidateArrayElementsRejectsMismatchedBool(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->validator()->callValidate(['a'], 'bool');
    }

    public function testValidateArrayElementsRejectsMismatchedClass(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->validator()->callValidate([new HydrationStub('A')], stdClass::class);
    }
}

class HydrationStub
{
    public function __construct(public string $sku)
    {
    }
}
