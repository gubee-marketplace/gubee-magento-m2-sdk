<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Library\HttpClient\Plugin;

use Gubee\SDK\Library\HttpClient\Plugin\Authenticate;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Http\Promise\FulfilledPromise;
use PHPUnit\Framework\TestCase;

class AuthenticateTest extends TestCase
{
    public function testHandleRequestAddsAuthorizationHeader(): void
    {
        $plugin   = new Authenticate('token-123');
        $response = new Response(200);
        $request  = new Request('GET', 'https://example.com/items');

        $promise = $plugin->handleRequest(
            $request,
            function (Request $request) use ($response): FulfilledPromise {
                TestCase::assertSame('Bearer token-123', $request->getHeaderLine('Authorization'));

                return new FulfilledPromise($response);
            },
            static function (): void {
            }
        );

        $this->assertSame($response, $promise->wait());
    }
}
