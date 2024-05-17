<?php

declare(strict_types=1);

namespace Gubee\SDK\Library\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class Builder
{
    protected ClientInterface $client;
    protected UriFactoryInterface $uriFactory;
    protected StreamFactoryInterface $streamFactory;
    protected RequestFactoryInterface $requestFactory;

    /** @var array<Plugin> */
    protected array $plugins = [];

    public function __construct(
        ?ClientInterface $client = null,
        ?UriFactoryInterface $uriFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
        ?RequestFactoryInterface $requestFactory = null
    ) {
        $this->client         = $client ?: Psr18ClientDiscovery::find();
        $this->uriFactory     = $uriFactory ?: Psr17FactoryDiscovery::findUriFactory();
        $this->streamFactory  = $streamFactory ?: Psr17FactoryDiscovery::findStreamFactory();
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
    }

    public function addPlugin(Plugin $plugin): self
    {
        $this->plugins[] = $plugin;
        return $this;
    }

    public function removePlugin(string $fqcn): self
    {
        foreach ($this->plugins as $key => $plugin) {
            if ($plugin instanceof $fqcn) {
                unset($this->plugins[$key]);
            }
        }
        return $this;
    }

    /**
     * Get the HTTP client.
     */
    public function getClient(): HttpMethodsClientInterface
    {
        $pluginClient = (new PluginClientFactory())
            ->createClient($this->client, $this->plugins);

        return new HttpMethodsClient(
            $pluginClient,
            $this->requestFactory,
            $this->streamFactory
        );
    }

    /**
     * Get the URI factory.
     */
    public function getUriFactory(): UriFactoryInterface
    {
        return $this->uriFactory;
    }

    /**
     * Get the stream factory.
     */
    public function getStreamFactory(): StreamFactoryInterface
    {
        return $this->streamFactory;
    }

    /**
     * Get the request factory.
     */
    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    /**
     * @return array<Plugin>
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }
}
