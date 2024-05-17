<?php

declare(strict_types=1);

namespace Gubee\SDK\Library\HttpClient\Plugin\Journal;

use Http\Client\Common\Plugin\Journal;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class History implements Journal
{
    protected ResponseInterface $lastResponse;
    protected LoggerInterface $logger;
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Record a successful call.
     *
     * @param RequestInterface  $request  Request use to make the call
     * @param ResponseInterface $response Response returned by the call
     */
    public function addSuccess(RequestInterface $request, ResponseInterface $response): void
    {
        $this->lastResponse = $response;
        $this->logger->info(
            'Request: ' . $request->getUri(),
            [
                'uri'     => (string) $request->getUri(),
                'method'  => $request->getMethod(),
                'headers' => $request->getHeaders(),
                'body'    => (string) $request->getBody(),
            ]
        );
        $this->logger->info(
            'Response: ' . $response->getStatusCode(),
            [
                'status'  => $response->getStatusCode(),
                'headers' => $response->getHeaders(),
                'body'    => (string) $response->getBody(),
                'reason'  => $response->getReasonPhrase(),
                'uri'     => (string) $request->getUri(),
                'method'  => $request->getMethod(),
            ]
        );
    }

    /**
     * Record a failed call.
     *
     * @param RequestInterface         $request   Request use to make the call
     * @param ClientExceptionInterface $exception Exception returned by the call
     */
    public function addFailure(RequestInterface $request, ClientExceptionInterface $exception): void
    {
        $this->logger->error(
            'Request: ' . $request->getUri(),
            [
                'uri'     => (string) $request->getUri(),
                'method'  => $request->getMethod(),
                'headers' => $request->getHeaders(),
                'body'    => (string) $request->getBody(),
            ]
        );
        $this->logger->error(
            'Exception: ' . $exception->getMessage(),
            [
                'uri'     => (string) $request->getUri(),
                'method'  => $request->getMethod(),
                'headers' => $request->getHeaders(),
                'body'    => (string) $request->getBody(),
            ]
        );
    }

    public function getLastResponse(): ResponseInterface
    {
        return $this->lastResponse;
    }
}
