<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Support;

use League\OpenAPIValidation\PSR7\OperationAddress;
use Psr\Http\Message\RequestInterface;

use function array_map;
use function array_slice;
use function array_values;
use function count;
use function dirname;
use function file_get_contents;
use function file_put_contents;
use function is_array;
use function is_dir;
use function json_decode;
use function json_encode;
use function mkdir;
use function preg_match_all;
use function preg_replace;
use function printf;
use function register_shutdown_function;
use function round;
use function strtoupper;
use function usort;

use const JSON_PRETTY_PRINT;
use const JSON_UNESCAPED_SLASHES;

final class OpenApiCoverageTracker
{
    private const OPENAPI_SPEC_FILE = ROOT . '/test/Integration/Contract/openapi-integration.json';
    private const OUTPUT_FILE       = '/var/test/openapi-coverage.json';
    private const STDOUT_LIMIT      = 20;

    private static bool $booted = false;
    /** @var list<array<string, string>>|null */
    private static ?array $operations = null;
    /** @var array<string, true> */
    private static array $covered     = [];
    private static int $recordedCalls = 0;

    public static function boot(): void
    {
        if (self::$booted) {
            return;
        }

        self::$booted = true;

        register_shutdown_function(static function (): void {
            self::report();
        });
    }

    public static function recordOperationAddress(OperationAddress $address): void
    {
        self::boot();
        self::$recordedCalls++;

        $key                 = self::operationKey($address->method(), $address->path());
        self::$covered[$key] = true;
    }

    public static function recordRequest(RequestInterface $request): void
    {
        self::boot();
        self::$recordedCalls++;

        $operation = self::findOperation($request->getMethod(), $request->getUri()->getPath());
        if ($operation === null) {
            return;
        }

        self::$covered[self::operationKey($operation['method'], $operation['path'])] = true;
    }

    public static function report(): void
    {
        if (self::$recordedCalls === 0) {
            return;
        }

        $operations = self::operations();
        $total      = count($operations);
        $covered    = count(self::$covered);
        $missing    = [];

        foreach ($operations as $operation) {
            $key = self::operationKey($operation['method'], $operation['path']);
            if (! isset(self::$covered[$key])) {
                $missing[] = $operation;
            }
        }

        $report = [
            'summary' => [
                'total'           => $total,
                'covered'         => $covered,
                'coveragePercent' => $total === 0 ? 100.0 : round(($covered / $total) * 100, 1),
                'recordedCalls'   => self::$recordedCalls,
            ],
            'missing' => array_map(
                static fn(array $operation): array => [
                    'operationId' => $operation['operationId'],
                    'method'      => $operation['method'],
                    'path'        => $operation['path'],
                ],
                $missing
            ),
        ];

        self::writeReport($report);

        printf(
            "\nOpenAPI contract coverage: %d/%d (%.1f%%)\n",
            $covered,
            $total,
            $report['summary']['coveragePercent']
        );

        if ($missing === []) {
            printf("OpenAPI report: %s\n", self::OUTPUT_FILE);
            print "OpenAPI missing operations: none\n";
            return;
        }

        printf("OpenAPI report: %s\n", self::OUTPUT_FILE);
        print "OpenAPI missing operations:\n";
        foreach (array_slice($missing, 0, self::STDOUT_LIMIT) as $operation) {
            printf(
                "- %s %s [%s]\n",
                $operation['method'],
                $operation['path'],
                $operation['operationId']
            );
        }

        if (count($missing) > self::STDOUT_LIMIT) {
            printf("- ... and %d more\n", count($missing) - self::STDOUT_LIMIT);
        }
    }

    /**
     * @return list<array{operationId:string,method:string,path:string}>
     */
    private static function operations(): array
    {
        if (self::$operations !== null) {
            return self::$operations;
        }

        $data       = json_decode((string) file_get_contents(self::OPENAPI_SPEC_FILE), true);
        $operations = [];

        foreach (($data['paths'] ?? []) as $path => $methods) {
            if (! is_array($methods)) {
                continue;
            }

            foreach ($methods as $method => $operation) {
                if (! is_array($operation)) {
                    continue;
                }

                $operations[] = [
                    'operationId' => (string) ($operation['operationId'] ?? strtoupper((string) $method) . ' ' . $path),
                    'method'      => strtoupper((string) $method),
                    'path'        => (string) $path,
                ];
            }
        }

        usort(
            $operations,
            static fn(array $left, array $right): int => [$left['path'], $left['method']] <=> [$right['path'], $right['method']]
        );

        self::$operations = array_values($operations);

        return self::$operations;
    }

    /**
     * @return array{operationId:string,method:string,path:string}|null
     */
    private static function findOperation(string $method, string $requestPath): ?array
    {
        $normalizedPath = self::normalizePath($requestPath);
        $matches        = [];

        foreach (self::operations() as $operation) {
            if ($operation['method'] !== strtoupper($method)) {
                continue;
            }

            if (! OperationAddress::isPathMatchesSpec($operation['path'], $normalizedPath)) {
                continue;
            }

            $matches[] = $operation;
        }

        if ($matches === []) {
            return null;
        }

        usort(
            $matches,
            static fn(array $left, array $right): int => self::pathSpecificity($right['path']) <=> self::pathSpecificity($left['path'])
        );

        return $matches[0];
    }

    private static function normalizePath(string $path): string
    {
        $normalized = preg_replace('#^/api(?=/|$)#', '', $path) ?? $path;

        return $normalized === '' ? '/' : $normalized;
    }

    private static function pathSpecificity(string $path): int
    {
        preg_match_all('/\{[^}]+\}/', $path, $placeholders);

        return 1000 - count($placeholders[0]);
    }

    private static function operationKey(string $method, string $path): string
    {
        return strtoupper($method) . ' ' . $path;
    }

    /**
     * @param array<string, mixed> $report
     */
    private static function writeReport(array $report): void
    {
        $file = dirname(__DIR__, 2) . self::OUTPUT_FILE;
        $dir  = dirname($file);

        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($file, json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
    }
}
