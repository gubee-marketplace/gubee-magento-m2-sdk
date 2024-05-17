<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Resource;

use Gubee\SDK\Client;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServer;
use PhpPact\Standalone\MockService\MockServerConfig;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use PHPUnit\Framework\TestCase;

// phpcs:ignoreFile
class TokenResourceTest extends TestCase
{
    /** @var MockServerConfig */
    private MockServerConfig $config;

    private MockServer $server;
    protected function setUp(): void
    {
        // Create your basic configuration. The host and port will need to match
        // whatever your Http Service will be using to access the providers data.
        $this->config = new MockServerConfig();
        $this->config->setHost('localhost');
        $this->config->setPort(7201);
        $this->config->setConsumer('someConsumer');
        $this->config->setProvider('someProvider');
        $this->config->setHealthCheckTimeout(60);
        $this->config->setHealthCheckRetrySec(5);
        $this->config->setCors(true);

        // Instantiate the mock server object with the config. This can be any
        // instance of MockServerConfigInterface.
        $this->server = new MockServer($this->config);

        // Create the process.
        $this->server->start();
    }

    protected function tearDown(): void
    {
        // Stop the process.
        $this->server->stop();
    }

    public function testGetHelloString(): void
    {
        // Create your expected request from the consumer.
        $request = new ConsumerRequest();
        $tokenString = 'a6as1d61as65d1a65sd165a1s6d51a65sd1a';
        $service = new Client(container());

        $request
            ->setMethod('POST')
            ->setPath('/api/integration/tokens/revalidate/apitoken');

        // Create your expected response from the provider.
        $response = new ProviderResponse();
        $responseData = [
            "id" => "string",
            "login" => "string",
            "revoked" => true,
            "sellerId" => "string",
            "token" => "string",
            "tokenType" => "ADMIN",
            "validity" => "2024-03-12T15:43:38.036Z",
        ];
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json')
            ->setBody($responseData);
        $config = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->uponReceiving('A get request to /hello/{name}')
            ->with($request)
            ->willRespondWith($response);
        $service->setUrl((string) $config->getBaseUri()->withPath(''));
        $result = $service->token()->revalidate($tokenString);
        $this->assertEquals($responseData['id'], $result->getId());
        $this->assertEquals($responseData['login'], $result->getLogin());
        $this->assertEquals($responseData['revoked'], $result->getRevoked());
        $this->assertEquals($responseData['sellerId'], $result->getSellerId());
        $this->assertEquals($responseData['token'], $result->getToken());
        $this->assertEquals($responseData['tokenType'], $result->getTokenType());
        $this->assertEquals($responseData['validity'], $result->getValidity());

        $builder->verify();
    }
}