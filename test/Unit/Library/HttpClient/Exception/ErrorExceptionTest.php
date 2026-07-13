<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Library\HttpClient\Exception;

use Gubee\SDK\Library\HttpClient\Exception\ErrorException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ErrorExceptionTest extends TestCase
{
    public function testConstructorGettersAndSetters(): void
    {
        $request  = new Request('POST', 'https://example.com/items');
        $response = new Response(500);
        $previous = new RuntimeException('previous');

        $exception = new ErrorException(
            $request,
            $response,
            'boom',
            500,
            2,
            'file.php',
            10,
            $previous
        );

        $this->assertSame('boom', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
        $this->assertSame($request, $exception->getRequest());
        $this->assertSame($response, $exception->getResponse());
        $this->assertSame($previous, $exception->getPrevious());

        $newRequest  = new Request('GET', 'https://example.com/other');
        $newResponse = new Response(404);

        $exception->setRequest($newRequest);
        $exception->setResponse($newResponse);

        $this->assertSame($newRequest, $exception->getRequest());
        $this->assertSame($newResponse, $exception->getResponse());
    }
}
