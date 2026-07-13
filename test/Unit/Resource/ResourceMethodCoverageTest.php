<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Resource;

use DateTimeImmutable;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Model\Common\ScrollResult;
use Gubee\SDK\Model\Common\StringList;
use Gubee\SDK\Model\Common\StringMap;
use Gubee\SDK\Model\Common\StringValue;
use Gubee\SDK\Resource\AbstractResource;
use Gubee\SDK\Resource\TokenResource;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use RuntimeException;
use TypeError;

use function array_map;
use function array_shift;
use function array_slice;
use function array_unique;
use function array_values;
use function class_exists;
use function file;
use function file_get_contents;
use function implode;
use function is_a;
use function json_encode;
use function ltrim;
use function method_exists;
use function preg_match;
use function preg_quote;
use function sort;
use function sprintf;
use function str_contains;
use function str_replace;
use function strlen;
use function substr;

final class ResourceMethodCoverageTest extends TestCase
{
    /**
     * @dataProvider resourceMethodProvider
     * @param class-string<AbstractResource> $resourceClass
     */
    public function testResourceMethodExecutesExpectedHydrationPath(
        string $resourceClass,
        string $methodName,
        string $mode,
        ?string $expectedModelClass
    ): void {
        $method       = new ReflectionMethod($resourceClass, $methodName);
        $body         = self::methodBody($method);
        $responseBody = $mode === 'collection' || str_contains($body, 'foreach')
            ? [['id' => 'one'], ['id' => 'two']]
            : ['id' => 'one', 'name' => 'stub'];

        if ($mode === 'paged_model') {
            $responseBody = [
                '_embedded' => [
                    'items' => [
                        ['id' => 'one', 'name' => 'stub'],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ];
        }

        if ($mode === 'scroll_model') {
            $responseBody = [
                'content'       => [
                    ['id' => 'one', 'name' => 'stub'],
                ],
                'scrollId'      => 'scroll-1',
                'pageSize'      => 1,
                'totalElements' => 1,
            ];
        }

        if ($resourceClass === TokenResource::class && $methodName === 'revalidate') {
            $responseBody = ['accessToken' => 'renewed'];
        }

        if ($expectedModelClass === StringValue::class) {
            $responseBody = 'stub-value';
        }

        if ($expectedModelClass === StringList::class) {
            $responseBody = ['one', 'two'];
        }

        if ($expectedModelClass === StringMap::class) {
            $responseBody = ['first' => 'one', 'second' => 'two'];
        }

        if ($expectedModelClass === EmptyResult::class) {
            $responseBody = [];
        }

        $serviceProvider = new ExhaustiveRecordingServiceProvider(
            $expectedModelClass === null
                ? []
                : [
                    $expectedModelClass => $mode === 'collection'
                        || $mode === 'bool_with_collection_hydration'
                        ? [$this->modelDouble($expectedModelClass), $this->modelDouble($expectedModelClass)]
                        : [$this->modelDouble($expectedModelClass)],
                ]
        );

        $resource  = new $resourceClass($this->newClient($serviceProvider, $responseBody));
        $arguments = array_map(fn(ReflectionParameter $parameter) => $this->argumentFor($parameter), $method->getParameters());

        if ($mode === 'type_error_after_model') {
            $this->expectException(TypeError::class);
            $resource->{$methodName}(...$arguments);
            return;
        }

        $result = $resource->{$methodName}(...$arguments);

        if ($mode === 'model') {
            self::assertInstanceOf($expectedModelClass, $result);
            self::assertCount(1, $serviceProvider->calls);
            self::assertSame($expectedModelClass, $serviceProvider->calls[0]['type']);
            return;
        }

        if ($mode === 'paged_model') {
            self::assertInstanceOf(PagedResult::class, $result);
            self::assertCount(1, $serviceProvider->calls);
            self::assertSame($expectedModelClass, $serviceProvider->calls[0]['type']);
            return;
        }

        if ($mode === 'scroll_model') {
            self::assertInstanceOf(ScrollResult::class, $result);
            self::assertCount(1, $serviceProvider->calls);
            self::assertSame($expectedModelClass, $serviceProvider->calls[0]['type']);
            return;
        }

        if ($mode === 'collection') {
            self::assertIsArray($result);
            self::assertCount(2, $result);
            foreach ($result as $item) {
                self::assertInstanceOf($expectedModelClass, $item);
            }
            self::assertCount(2, $serviceProvider->calls);
            return;
        }

        if ($mode === 'bool_with_collection_hydration') {
            self::assertIsBool($result);
            self::assertCount(2, $serviceProvider->calls);
            return;
        }

        self::assertSame([], $serviceProvider->calls);

        $returnType = $method->getReturnType();
        if ($returnType instanceof ReflectionNamedType && $returnType->getName() === 'void') {
            self::assertNull($result);
            return;
        }

        if ($returnType instanceof ReflectionNamedType && $returnType->getName() === 'bool') {
            self::assertIsBool($result);
            return;
        }

        if ($result === null) {
            self::assertNull($result);
            return;
        }

        self::assertIsArray($result);
    }

    /**
     * @return iterable<string, array{class-string<AbstractResource>, string, string, ?string}>
     */
    public static function resourceMethodProvider(): iterable
    {
        foreach (self::resourceClasses() as $resourceClass) {
            $reflection = new ReflectionClass($resourceClass);

            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->class !== $resourceClass || $method->isConstructor()) {
                    continue;
                }

                [$mode, $expectedModelClass] = self::expectationFor($method);
                yield $resourceClass . '::' . $method->getName() => [$resourceClass, $method->getName(), $mode, $expectedModelClass];
            }
        }
    }

    /**
     * @return list<class-string<AbstractResource>>
     */
    private static function resourceClasses(): array
    {
        $classes = [];

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ROOT . '/src/Resource'));

        foreach ($iterator as $file) {
            if (! $file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $path = $file->getPathname();
            if (str_contains($path, '/AbstractResource.php') || str_contains($path, '/ResultPager.php')) {
                continue;
            }

            $classes[] = 'Gubee\\SDK\\' . str_replace(['/', '.php'], ['\\', ''], substr($path, strlen(ROOT . '/src/')));
        }

        $classes = array_values(array_unique($classes));
        sort($classes);

        return $classes;
    }

    /**
     * @return array{string, ?string}
     */
    private static function expectationFor(ReflectionMethod $method): array
    {
        $body = self::methodBody($method);

        $returnType = $method->getReturnType();
        if ($returnType instanceof ReflectionNamedType && $returnType->getName() === 'bool') {
            if (str_contains($body, 'foreach') && preg_match('/create\(\s*\\\\?([A-Za-z0-9_\\\\]+)::class/s', $body, $matches)) {
                return ['bool_with_collection_hydration', self::resolveClassName($method, $matches[1])];
            }

            return ['raw', null];
        }

        if ($returnType instanceof ReflectionNamedType && $returnType->getName() === 'void') {
            return ['raw', null];
        }

        if (preg_match('/hydrateCollection\(\s*\\\\?([A-Za-z0-9_\\\\]+)::class/s', $body, $matches)) {
            return ['collection', self::resolveClassName($method, $matches[1])];
        }

        if (preg_match('/hydratePagedResult\(\s*\\\\?([A-Za-z0-9_\\\\]+)::class/s', $body, $matches)) {
            return ['paged_model', self::resolveClassName($method, $matches[1])];
        }

        if (preg_match('/hydrateScrollResult\(\s*\\\\?([A-Za-z0-9_\\\\]+)::class/s', $body, $matches)) {
            return ['scroll_model', self::resolveClassName($method, $matches[1])];
        }

        if (str_contains($body, 'foreach') && preg_match('/create\(\s*\\\\?([A-Za-z0-9_\\\\]+)::class/s', $body, $matches)) {
            return ['collection', self::resolveClassName($method, $matches[1])];
        }

        if (preg_match('/(?:hydrateModel|create)\(\s*\\\\?([A-Za-z0-9_\\\\]+)::class/s', $body, $matches)) {
            if ($returnType instanceof ReflectionNamedType && $returnType->getName() === 'array') {
                return ['type_error_after_model', self::resolveClassName($method, $matches[1])];
            }

            return ['model', self::resolveClassName($method, $matches[1])];
        }

        if ($returnType instanceof ReflectionNamedType && ! $returnType->isBuiltin()) {
            return ['model', self::resolveClassName($method, $returnType->getName())];
        }

        return ['raw', null];
    }

    private static function methodBody(ReflectionMethod $method): string
    {
        $lines = file($method->getFileName()) ?: [];

        return implode('', array_slice($lines, $method->getStartLine() - 1, $method->getEndLine() - $method->getStartLine() + 1));
    }

    /**
     * @param class-string|non-empty-string $className
     * @return class-string
     */
    private static function resolveClassName(ReflectionMethod $method, string $className): string
    {
        $className = ltrim($className, '\\');
        $contents  = file_get_contents($method->getFileName()) ?: '';
        if (preg_match('/use\s+([^;]+\\\\' . preg_quote($className, '/') . ')\s*;/', $contents, $matches)) {
            return ltrim($matches[1], '\\');
        }

        if (class_exists($className)) {
            return $className;
        }

        return $method->getDeclaringClass()->getNamespaceName() . '\\' . $className;
    }

    /**
     * @return mixed
     */
    private function argumentFor(ReflectionParameter $parameter)
    {
        $type = $parameter->getType();

        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $unionType) {
                if ($unionType instanceof ReflectionNamedType && $unionType->getName() === 'array') {
                    return ['payload' => true];
                }
            }

            foreach ($type->getTypes() as $unionType) {
                if ($unionType instanceof ReflectionNamedType && $unionType->getName() !== 'null') {
                    return $this->argumentForNamedType($unionType, $parameter);
                }
            }
        }

        if ($type instanceof ReflectionNamedType) {
            return $this->argumentForNamedType($type, $parameter);
        }

        return ['page' => 0, 'size' => 10];
    }

    /**
     * @return mixed
     */
    private function argumentForNamedType(ReflectionNamedType $type, ReflectionParameter $parameter)
    {
        if ($type->isBuiltin()) {
            return match ($type->getName()) {
                'string' => $parameter->getName() === 'payload' ? 'payload' : $parameter->getName() . '-value',
                'int' => 1,
                'bool' => true,
                'array' => ['page' => 0, 'size' => 10],
                default => null,
            };
        }

        $className = $type->getName();

        if (is_a($className, DateTimeInterface::class, true)) {
            return new DateTimeImmutable('2024-01-01T00:00:00+00:00');
        }

        if (substr($className, -8) === 'SortEnum' && method_exists($className, 'ASC')) {
            return $className::ASC();
        }

        $mock = $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->getMock();

        if (method_exists($className, 'jsonSerialize')) {
            $mock->method('jsonSerialize')->willReturn(['payload' => true]);
        }

        return $mock;
    }

    /**
     * @param class-string $className
     * @return object&MockObject
     */
    private function modelDouble(string $className)
    {
        $reflection = new ReflectionClass($className);

        if ($reflection->isInstantiable()) {
            /** @var object&MockObject $instance */
            $instance = $reflection->newInstanceWithoutConstructor();

            return $instance;
        }

        return $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param mixed $responseBody
     */
    private function newClient(ExhaustiveRecordingServiceProvider $serviceProvider, $responseBody): Client
    {
        $httpClient = new ExhaustiveStaticResponseHttpClient(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                (string) json_encode($responseBody)
            )
        );

        $client = new Client($serviceProvider, null, new Builder($httpClient), 0);
        $client->setUrl('https://example.test');

        return $client;
    }
}

final class ExhaustiveRecordingServiceProvider implements ServiceProviderInterface
{
    /** @var list<array{type:string, arguments:array<mixed, mixed>}> */
    public array $calls = [];

    /** @var array<class-string, list<object>> */
    private array $instancesByType;

    /**
     * @param array<class-string, list<object>> $instancesByType
     */
    public function __construct(array $instancesByType)
    {
        $this->instancesByType = $instancesByType;
    }

    public function get($id)
    {
        throw new class ('Not implemented for this test.') extends RuntimeException implements NotFoundExceptionInterface {
        };
    }

    public function has($id): bool
    {
        return false;
    }

    public function create(string $type, array $arguments = [])
    {
        $this->calls[] = [
            'type'      => $type,
            'arguments' => $arguments,
        ];

        if (! isset($this->instancesByType[$type][0])) {
            throw new RuntimeException(sprintf('No test double registered for %s', $type));
        }

        return array_shift($this->instancesByType[$type]);
    }
}

final class ExhaustiveStaticResponseHttpClient implements ClientInterface
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->response;
    }
}
