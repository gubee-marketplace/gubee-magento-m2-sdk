<?php

declare(strict_types=1);

namespace Gubee\SDK\Library\HttpClient\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ErrorException extends \ErrorException implements ExceptionInterface
{
    /**
     * Request that caused the exception.
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Response that caused the exception.
     *
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        string $message,
        int $code = 0,
        int $severity = 1,
        string $filename = __FILE__,
        int $lineno = __LINE__,
        ?Throwable $previous = null
    ) {
        $this->request  = $request;
        $this->response = $response;
        parent::__construct($message, $code, $severity, $filename, $lineno, $previous);
    }

    /**
     * Request that caused the exception.
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Request that caused the exception.
     *
     * @param RequestInterface $request Request that caused the exception.
     */
    public function setRequest($request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Response that caused the exception.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Response that caused the exception.
     *
     * @param ResponseInterface $response Response that caused the exception.
     */
    public function setResponse($response): self
    {
        $this->response = $response;
        return $this;
    }
}
