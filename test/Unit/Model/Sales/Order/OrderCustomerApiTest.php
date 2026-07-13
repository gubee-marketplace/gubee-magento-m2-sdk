<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\GenderEnum;
use Gubee\SDK\Model\Common\Document;
use Gubee\SDK\Model\Common\Phone;
use Gubee\SDK\Model\Sales\Order\OrderCustomerApi;
use PHPUnit\Framework\TestCase;

class OrderCustomerApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): OrderCustomerApi
    {
        return $this->serviceProvider()->create(
            OrderCustomerApi::class,
            $overrides + [
                'name'          => 'John Doe',
                'recipientName' => 'John Recipient',
                'receiverName'  => 'John Receiver',
                'email'         => 'john@example.com',
                'dateOfBirth'   => '1990-01-01',
                'gender'        => 'MALE',
                'documents'     => [['number' => '123']],
                'phones'        => [['number' => '5511999999999']],
            ]
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('John Doe', $model->getName());
        $this->assertSame('John Recipient', $model->getRecipientName());
        $this->assertSame('John Receiver', $model->getReceiverName());
        $this->assertSame('john@example.com', $model->getEmail());
        $this->assertSame('1990-01-01', $model->getDateOfBirth());
        $this->assertInstanceOf(GenderEnum::class, $model->getGender());
        $this->assertContainsOnlyInstancesOf(Document::class, $model->getDocuments());
        $this->assertContainsOnlyInstancesOf(Phone::class, $model->getPhones());
    }

    public function testConstructorWithNullOptionalFieldsAndEmptyArrays(): void
    {
        $model = $this->buildModel([
            'name'          => null,
            'recipientName' => null,
            'receiverName'  => null,
            'email'         => null,
            'dateOfBirth'   => null,
            'gender'        => null,
            'documents'     => [],
            'phones'        => [],
        ]);

        $this->assertNull($model->getName());
        $this->assertNull($model->getRecipientName());
        $this->assertNull($model->getReceiverName());
        $this->assertNull($model->getEmail());
        $this->assertNull($model->getDateOfBirth());
        $this->assertNull($model->getGender());
        $this->assertSame([], $model->getDocuments());
        $this->assertSame([], $model->getPhones());
    }

    public function testConstructorPassesThroughAlreadyHydratedInstancesAndEnum(): void
    {
        $document = $this->serviceProvider()->create(Document::class, ['number' => '456']);
        $phone    = $this->serviceProvider()->create(Phone::class, ['number' => '5511888888888']);

        $model = $this->buildModel([
            'gender'    => GenderEnum::fromValue('FEMALE'),
            'documents' => [$document],
            'phones'    => [$phone],
        ]);

        $this->assertSame('FEMALE', (string) $model->getGender());
        $this->assertSame($document, $model->getDocuments()[0]);
        $this->assertSame($phone, $model->getPhones()[0]);
    }

    public function testSetters(): void
    {
        $model    = $this->buildModel();
        $document = $this->serviceProvider()->create(Document::class, ['number' => '789']);
        $phone    = $this->serviceProvider()->create(Phone::class, ['number' => '5511777777777']);

        $model->setName('Jane Doe');
        $model->setRecipientName('Jane Recipient');
        $model->setReceiverName('Jane Receiver');
        $model->setEmail('jane@example.com');
        $model->setDateOfBirth('1991-02-02');
        $model->setGender(GenderEnum::fromValue('FEMALE'));
        $model->setDocuments([$document]);
        $model->setPhones([$phone]);

        $this->assertSame('Jane Doe', $model->getName());
        $this->assertSame('Jane Recipient', $model->getRecipientName());
        $this->assertSame('Jane Receiver', $model->getReceiverName());
        $this->assertSame('jane@example.com', $model->getEmail());
        $this->assertSame('1991-02-02', $model->getDateOfBirth());
        $this->assertSame('FEMALE', (string) $model->getGender());
        $this->assertSame([$document], $model->getDocuments());
        $this->assertSame([$phone], $model->getPhones());
    }
}
