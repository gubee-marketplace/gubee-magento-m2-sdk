<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\ValidateProductMessageApi;
use Gubee\SDK\Model\Catalog\Product\ValidateProductResponseApi;
use PHPUnit\Framework\TestCase;

class ValidateProductResponseApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): ValidateProductResponseApi
    {
        return $this->serviceProvider()->create(
            ValidateProductResponseApi::class,
            $overrides + [
                'valid'    => true,
                'messages' => [['domainId' => 'domainId-1', 'code' => 'code-1']],
            ]
        );
    }

    public function testHydratesMessagesFromRawArrays(): void
    {
        $response = $this->build();

        $this->assertTrue($response->getValid());
        $this->assertContainsOnlyInstancesOf(ValidateProductMessageApi::class, $response->getMessages());
    }

    public function testPassesThroughAlreadyHydratedMessages(): void
    {
        $message = $this->serviceProvider()->create(ValidateProductMessageApi::class, ['domainId' => 'domainId-2']);

        $response = $this->build(['messages' => [$message]]);

        $this->assertSame($message, $response->getMessages()[0]);
    }

    public function testSetters(): void
    {
        $response = $this->build();

        $response->setValid(false);
        $response->setMessages([]);

        $this->assertFalse($response->getValid());
        $this->assertSame([], $response->getMessages());
    }
}
