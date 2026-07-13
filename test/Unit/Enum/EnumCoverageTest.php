<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Enum;

use Gubee\SDK\Enum\AbstractEnum;
use Gubee\SDK\Enum\Resource\SortEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionMethod;

use function array_filter;
use function dirname;
use function is_subclass_of;
use function ksort;
use function sprintf;
use function str_replace;
use function strlen;
use function substr;

class EnumCoverageTest extends TestCase
{
    /**
     * @dataProvider enumClassProvider
     * @param class-string<AbstractEnum> $enumClass
     */
    public function testStaticFactoriesFromValueAndSerialization(string $enumClass): void
    {
        $reflection = new ReflectionClass($enumClass);
        $methods    = array_filter(
            $reflection->getMethods(ReflectionMethod::IS_STATIC | ReflectionMethod::IS_PUBLIC),
            static function (ReflectionMethod $method) use ($enumClass): bool {
                return $method->getNumberOfRequiredParameters() === 0
                    && $method->isStatic()
                    && $method->getName() !== 'fromValue'
                    && $method->getDeclaringClass()->getName() === $enumClass;
            }
        );

        $this->assertNotEmpty($methods, sprintf('No enum factories found for %s', $enumClass));

        foreach ($methods as $method) {
            /** @var AbstractEnum $enum */
            $enum = $enumClass::{$method->getName()}();

            $this->assertInstanceOf($enumClass, $enum);
            $this->assertSame((string) $enum, $enum->jsonSerialize());
            $this->assertSame((string) $enum, (string) $enumClass::fromValue((string) $enum));
        }
    }

    public function testFromValueRejectsInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid value 'INVALID_VALUE'");

        SortEnum::fromValue('INVALID_VALUE');
    }

    /**
     * @return array<string, array{class-string<AbstractEnum>}>
     */
    public function enumClassProvider(): array
    {
        $basePath = dirname(__DIR__, 3) . '/src/Enum';
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basePath));
        $classes  = [];

        foreach ($iterator as $file) {
            if (! $file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $path         = $file->getPathname();
            $relativePath = substr($path, strlen($basePath . '/'));
            $class        = 'Gubee\\SDK\\Enum\\' . str_replace(['/', '.php'], ['\\', ''], $relativePath);

            if ($class === AbstractEnum::class || ! is_subclass_of($class, AbstractEnum::class)) {
                continue;
            }

            $classes[$class] = [$class];
        }

        ksort($classes);

        return $classes;
    }
}
