<?php

declare (strict_types = 1);

namespace Gubee\SDK;

use DI\ContainerBuilder;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Library\HttpClient\Plugin\Authenticate;
use Gubee\SDK\Library\HttpClient\Plugin\Journal\History;
use Gubee\SDK\Library\HttpClient\Plugin\Thrower;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RetryPlugin;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client {
    public const USER_AGENT = 'gubee-sdk/' . self::VERSION;
    public const VERSION = '1.0.0';
    public const BASE_URI = 'https://api.gubee.com.br';

    protected $serviceProvider;
    protected $logger;
    protected $httpClientBuilder;
    protected $responseHistory;

    public function __construct(
        ?ServiceProviderInterface $serviceProvider = null,
        ?LoggerInterface $logger = null,
        ?Builder $httpClientBuilder = null,
        int $retryCount = 3
    ) {
        $this->serviceProvider = $serviceProvider ?? $this->buildServiceProvider();
        $this->logger = $logger ?? new NullLogger();
        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
        $this->responseHistory = new History($this->logger);
        $this->httpClientBuilder->addPlugin(
            new HistoryPlugin($this->responseHistory)
        );
        $this->httpClientBuilder->addPlugin(
            new RetryPlugin([
                'retries' => $retryCount,
                'exception_decider' => function ($request, $exception) { $this->shouldRetry($request, $exception); },
            ])
        );

        $this->httpClientBuilder->addPlugin(
            new Thrower($this->logger)
        );
        $this->httpClientBuilder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => self::USER_AGENT,
            ])
        );
        $this->setUrl(self::BASE_URI);
    }

    private function shouldRetry(RequestInterface $request, \Throwable $exception): bool {
        /**
         * The list of HTTP status codes that should trigger a retry.
         *
         * The following status codes are included:
         * - 429: Too Many Requests
         * - 422: Unprocessable Entity
         * - 410: Gone
         * - 408: Request Timeout
         * - 444: No Response
         * - 449: Retry With
         *
         * @var array
         */
        $tryAgain = [429, 422, 410, 408, 444, 449];
        if ($exception instanceof ClientExceptionInterface) {
            $response = $exception->getResponse();
            return isset($response) && (
                in_array($response->getStatusCode(), $tryAgain) ||
                $response->getStatusCode() >= 500
            );
        }
        return false;
    }

    public function attribute(): Resource\Catalog\Product\AttributeResource {
        return new Resource\Catalog\Product\AttributeResource($this);
    }

    public function token(): Resource\TokenResource {
        return new Resource\TokenResource($this);
    }

    public function authenticate(string $token) {
        $this->httpClientBuilder->removePlugin(
            Authenticate::class
        )->addPlugin(
            new Authenticate($token)
        );
        return $this;
    }

    /**
     * Get the HTTP client.
     */
    public function getHttpClient(): HttpMethodsClientInterface {
        return $this->httpClientBuilder->getClient();
    }

    /**
     * Set the base URL for the client.
     */
    public function setUrl(string $url) {
        $uri = $this->httpClientBuilder->getUriFactory()
            ->createUri($url);

        $this->httpClientBuilder->removePlugin(
            BaseUriPlugin::class
        )->addPlugin(
            new BaseUriPlugin($uri)
        );
        return $this;
    }

    public function getServiceProvider(): ServiceProviderInterface {
        return $this->serviceProvider;
    }

    public function getLogger(): LoggerInterface {
        return $this->logger;
    }

    public function getHttpClientBuilder(): Builder {
        return $this->httpClientBuilder;
    }

    public function getStreamFactory(): StreamFactoryInterface {
        return $this->httpClientBuilder->getStreamFactory();
    }

    public function getRequestFactory(): RequestFactoryInterface {
        return $this->httpClientBuilder->getRequestFactory();
    }

    public function buildServiceProvider(): ServiceProviderInterface {
        $containerBuilder = new ContainerBuilder(
            ServiceProvider::class
        );
        $defs = include __DIR__ . '/config/di.php';
        $containerBuilder->addDefinitions(
            $defs
        );
        $containerBuilder->useAutowiring(true);
        $result = $containerBuilder->build();

        return $result->get(ServiceProviderInterface::class);
    }

    /**
     * Get the last response.
     */
    public function getLastResponse(): ?ResponseInterface {
        return $this->responseHistory->getLastResponse();
    }
}
