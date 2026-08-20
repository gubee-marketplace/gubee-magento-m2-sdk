<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Library\HttpClient\Plugin\Journal;

use Gubee\SDK\Library\HttpClient\Plugin\Journal\History;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;

class HistoryTest extends TestCase
{
    public function testAddSuccessLogsRequestAndResponseAndStoresLastResponse(): void
    {
        $logger   = $this->createMock(LoggerInterface::class);
        $request  = new Request('POST', 'https://example.com/items', ['X-Test' => ['1']], Utils::streamFor('request-body'));
        $response = new Response(201, ['Y-Test' => ['2']], Utils::streamFor('response-body'), 'Created');

        $logger->expects($this->exactly(2))
            ->method('info')
            ->withConsecutive(
                [
                    'Request: https://example.com/items',
                    [
                        'uri'     => 'https://example.com/items',
                        'method'  => 'POST',
                        'headers' => ['Host' => ['example.com'], 'X-Test' => ['1']],
                        'body'    => 'request-body',
                    ],
                ],
                [
                    'Response: 201',
                    [
                        'status'  => 201,
                        'headers' => ['Y-Test' => ['2']],
                        'body'    => 'response-body',
                        'reason'  => 'Created',
                        'uri'     => 'https://example.com/items',
                        'method'  => 'POST',
                    ],
                ]
            );

        $history = new History($logger);
        $history->addSuccess($request, $response);

        $this->assertSame($response, $history->getLastResponse());
    }

    public function testAddFailureLogsRequestAndException(): void
    {
        $logger    = $this->createMock(LoggerInterface::class);
        $request   = new Request('GET', 'https://example.com/items', [], Utils::streamFor('request-body'));
        $exception = new class ('boom') extends RuntimeException implements ClientExceptionInterface {
        };

        $logger->expects($this->exactly(2))
            ->method('error')
            ->withConsecutive(
                [
                    'Request: https://example.com/items',
                    [
                        'uri'     => 'https://example.com/items',
                        'method'  => 'GET',
                        'headers' => ['Host' => ['example.com']],
                        'body'    => 'request-body',
                    ],
                ],
                [
                    'Exception: boom',
                    [
                        'uri'     => 'https://example.com/items',
                        'method'  => 'GET',
                        'headers' => ['Host' => ['example.com']],
                        'body'    => 'request-body',
                    ],
                ]
            );

        $history = new History($logger);
        $history->addFailure($request, $exception);

        $this->assertTrue(true);
    }
}
