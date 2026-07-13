<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Library\HttpClient\Plugin;

use Gubee\SDK\Library\HttpClient\Exception\BadGatewayException;
use Gubee\SDK\Library\HttpClient\Exception\BadRequestException;
use Gubee\SDK\Library\HttpClient\Exception\ConflictException;
use Gubee\SDK\Library\HttpClient\Exception\ErrorException;
use Gubee\SDK\Library\HttpClient\Exception\ForbiddenException;
use Gubee\SDK\Library\HttpClient\Exception\GatewayTimeoutException;
use Gubee\SDK\Library\HttpClient\Exception\InternalServerErrorException;
use Gubee\SDK\Library\HttpClient\Exception\MethodNotAllowedException;
use Gubee\SDK\Library\HttpClient\Exception\NotAcceptableException;
use Gubee\SDK\Library\HttpClient\Exception\NotFoundException;
use Gubee\SDK\Library\HttpClient\Exception\NotImplementedException;
use Gubee\SDK\Library\HttpClient\Exception\ServiceUnavailableException;
use Gubee\SDK\Library\HttpClient\Exception\TooManyRequestsException;
use Gubee\SDK\Library\HttpClient\Exception\UnauthorizedException;
use Gubee\SDK\Library\HttpClient\Exception\UnprocessableEntityException;
use Gubee\SDK\Library\HttpClient\Exception\UnsupportedMediaTypeException;
use Gubee\SDK\Library\HttpClient\Plugin\Thrower;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Http\Promise\FulfilledPromise;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ThrowerTest extends TestCase
{
    /**
     * @dataProvider exceptionStatusProvider
     */
    public function testCreateExceptionMapsStatusCodes(int $statusCode, string $expectedClass): void
    {
        $exception = Thrower::createException(
            $statusCode,
            '{"title":"failure"}',
            new Request('GET', 'https://example.com/items'),
            new Response($statusCode)
        );

        $this->assertInstanceOf($expectedClass, $exception);
        $this->assertSame('failure', $exception->getMessage());
        $this->assertSame($statusCode, $exception->getCode());
    }

    public function testCreateExceptionMapsBrandNotFoundToNotFoundWithTitle(): void
    {
        $exception = Thrower::createException(
            400,
            '{"message":"error.brand.notfound","title":"Brand missing"}',
            new Request('GET', 'https://example.com/items'),
            new Response(400)
        );

        $this->assertInstanceOf(NotFoundException::class, $exception);
        $this->assertSame('Brand missing', $exception->getMessage());
        $this->assertSame(404, $exception->getCode());
    }

    public function testCreateExceptionFormatsValidationErrors(): void
    {
        $exception = Thrower::createException(
            422,
            '{"message":"error.validation.text","fieldErrors":[{"objectName":"Product","field":"sku","message":"required"},{"objectName":"Price","field":"value","message":"invalid"}]}',
            new Request('POST', 'https://example.com/items'),
            new Response(422)
        );

        $this->assertInstanceOf(UnprocessableEntityException::class, $exception);
        $this->assertSame("Object validation failed:\nProduct:sku: required\nPrice:value: invalid", $exception->getMessage());
    }

    public function testCreateExceptionFallsBackToJsonEncodedBody(): void
    {
        $exception = Thrower::createException(
            418,
            '{"foo":"bar"}',
            new Request('GET', 'https://example.com/items'),
            new Response(418)
        );

        $this->assertInstanceOf(ErrorException::class, $exception);
        $this->assertStringContainsString('"foo"', $exception->getMessage());
    }

    public function testCreateExceptionUsesDefaultMessageBranch(): void
    {
        $exception = Thrower::createException(
            400,
            '{"message":"plain-error"}',
            new Request('GET', 'https://example.com/items'),
            new Response(400)
        );

        $this->assertInstanceOf(BadRequestException::class, $exception);
        $this->assertSame('plain-error', $exception->getMessage());
    }

    public function testHandleRequestReturnsResponseOnSuccess(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->never())->method('error');

        $plugin   = new Thrower($logger);
        $request  = new Request('GET', 'https://example.com/items');
        $response = new Response(200);

        $promise = $plugin->handleRequest(
            $request,
            static fn () => new FulfilledPromise($response),
            static function (): void {
            }
        );

        $this->assertSame($response, $promise->wait());
    }

    public function testHandleRequestLogsAndThrowsMappedException(): void
    {
        $logger   = $this->createMock(LoggerInterface::class);
        $request  = new Request('POST', 'https://example.com/items', ['X-Test' => ['1']], Utils::streamFor('request-body'));
        $response = new Response(404, ['Y-Test' => ['2']], Utils::streamFor('{"title":"missing"}'));

        $logger->expects($this->once())
            ->method('error')
            ->with(
                'missing',
                [
                    'request'  => [
                        'method'  => 'POST',
                        'headers' => ['Host' => ['example.com'], 'X-Test' => ['1']],
                        'body'    => 'request-body',
                        'uri'     => 'https://example.com/items',
                    ],
                    'response' => [
                        'status'  => 404,
                        'headers' => ['Y-Test' => ['2']],
                        'body'    => '{"title":"missing"}',
                    ],
                ]
            );

        $plugin  = new Thrower($logger);
        $promise = $plugin->handleRequest(
            $request,
            static fn () => new FulfilledPromise($response),
            static function (): void {
            }
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('missing');

        $promise->wait();
    }

    /**
     * @return array<string, array{int, class-string}>
     */
    public function exceptionStatusProvider(): array
    {
        return [
            '400' => [400, BadRequestException::class],
            '401' => [401, UnauthorizedException::class],
            '403' => [403, ForbiddenException::class],
            '404' => [404, NotFoundException::class],
            '405' => [405, MethodNotAllowedException::class],
            '406' => [406, NotAcceptableException::class],
            '409' => [409, ConflictException::class],
            '415' => [415, UnsupportedMediaTypeException::class],
            '422' => [422, UnprocessableEntityException::class],
            '429' => [429, TooManyRequestsException::class],
            '500' => [500, InternalServerErrorException::class],
            '501' => [501, NotImplementedException::class],
            '502' => [502, BadGatewayException::class],
            '503' => [503, ServiceUnavailableException::class],
            '504' => [504, GatewayTimeoutException::class],
            '418' => [418, ErrorException::class],
        ];
    }
}
