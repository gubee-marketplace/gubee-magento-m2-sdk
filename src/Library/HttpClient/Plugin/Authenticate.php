<?php

declare(strict_types=1);

namespace Gubee\SDK\Library\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

use function sprintf;

class Authenticate implements Plugin
{
    protected string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $request = $request->withHeader(
            "Authorization",
            sprintf("Bearer %s", $this->token)
        );

        return $next($request);
    }
}
