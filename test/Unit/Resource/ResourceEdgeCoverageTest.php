<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Resource;

use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Model\Sales\Order\OrderApi;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use Gubee\SDK\Resource\Sales\OrderResource;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

use function json_decode;
use function json_encode;

final class ResourceEdgeCoverageTest extends TestCase
{
    public function testBrandUpdateByExternalIdThrowsWhenBrandHasNoId(): void
    {
        $brand = $this->getMockBuilder(Brand::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getId'])
            ->getMock();
        $brand->method('getId')->willReturn('');

        $resource = new BrandResource($this->newClient(['id' => 'b-1']));

        $this->expectException(InvalidArgumentException::class);
        $resource->updateByExternalId($brand);
    }

    public function testBrandUpdateByNameThrowsWhenBrandHasNoName(): void
    {
        $brand = $this->getMockBuilder(Brand::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $brand->method('getName')->willReturn('');

        $resource = new BrandResource($this->newClient(['id' => 'b-1']));

        $this->expectException(InvalidArgumentException::class);
        $resource->updateByName($brand);
    }

    public function testBrandUpdateByNameV2ThrowsWhenBrandHasNoName(): void
    {
        $brand = $this->getMockBuilder(Brand::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();
        $brand->method('getName')->willReturn('');

        $resource = new BrandResource($this->newClient(['id' => 'b-1']));

        $this->expectException(InvalidArgumentException::class);
        $resource->updateByNameV2($brand);
    }

    public function testCancelOrderDefaultsToUtcNowWhenDateIsOmitted(): void
    {
        $order      = $this->getMockBuilder(OrderApi::class)
            ->disableOriginalConstructor()
            ->getMock();
        $httpClient = new RecordingHttpClient(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode(['id' => 'ord-1']))
        );
        $client     = new Client(new NullServiceProviderWithCreateResult($order), null, new Builder($httpClient), 0);
        $client->setUrl('https://example.test');
        $resource = new OrderResource($client);

        self::assertSame($order, $resource->cancelOrder('ord-1'));

        $payload = json_decode((string) $httpClient->lastRequest?->getBody(), true);
        self::assertSame('PUT', $httpClient->lastRequest?->getMethod());
        self::assertArrayHasKey('cancelDt', $payload);
        self::assertStringEndsWith('Z', $payload['cancelDt']);
    }

    private function newClient(array $responseBody): Client
    {
        $httpClient = new RecordingHttpClient(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                (string) json_encode($responseBody)
            )
        );

        $client = new Client(new NullServiceProvider(), null, new Builder($httpClient), 0);
        $client->setUrl('https://example.test');

        return $client;
    }
}
