<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Common\StateRegistrationIndicatorEnum;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Common\Document;
use Gubee\SDK\Model\Common\Phone;
use Gubee\SDK\Model\Sales\Order\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): Customer
    {
        return $this->serviceProvider()->create(
            Customer::class,
            $overrides + [
                'name'                       => 'John Doe',
                'recipientName'              => 'John Recipient',
                'receiverName'               => 'John Receiver',
                'email'                      => 'john@example.com',
                'address'                    => ['street' => 'Main St'],
                'dateOfBirth'                => '1990-01-01',
                'documents'                  => [['number' => '123', 'type' => 'CPF']],
                'phones'                     => [['number' => '999999999', 'type' => 'CELLPHONE']],
                'stateRegistrationIndicator' => 'CONTRIBUINTE_ICMS',
                'stateRegistration'          => 'sr-1',
            ]
        );
    }

    public function testHydratesNestedModelsFromRawArrays(): void
    {
        $customer = $this->build();

        $this->assertSame('John Doe', $customer->getName());
        $this->assertSame('John Recipient', $customer->getRecipientName());
        $this->assertSame('John Receiver', $customer->getReceiverName());
        $this->assertSame('john@example.com', $customer->getEmail());
        $this->assertInstanceOf(Address::class, $customer->getAddress());
        $this->assertInstanceOf(DateTimeInterface::class, $customer->getDateOfBirth());
        $this->assertSame('1990-01-01', $customer->getDateOfBirth()->format('Y-m-d'));
        $this->assertContainsOnlyInstancesOf(Document::class, $customer->getDocuments());
        $this->assertContainsOnlyInstancesOf(Phone::class, $customer->getPhones());
        $this->assertEquals(StateRegistrationIndicatorEnum::fromValue('CONTRIBUINTE_ICMS'), $customer->getStateRegistrationIndicator());
        $this->assertSame('sr-1', $customer->getStateRegistration());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $address  = $this->serviceProvider()->create(Address::class, ['street' => 'Other St']);
        $document = $this->serviceProvider()->create(Document::class, ['number' => '456']);
        $phone    = $this->serviceProvider()->create(Phone::class, ['number' => '888888888']);

        $customer = $this->build([
            'address'   => $address,
            'documents' => [$document],
            'phones'    => [$phone],
        ]);

        $this->assertSame($address, $customer->getAddress());
        $this->assertSame($document, $customer->getDocuments()[0]);
        $this->assertSame($phone, $customer->getPhones()[0]);
    }

    public function testSetters(): void
    {
        $customer = $this->build();
        $address  = $this->serviceProvider()->create(Address::class, ['street' => 'New St']);
        $document = $this->serviceProvider()->create(Document::class, ['number' => '789']);
        $phone    = $this->serviceProvider()->create(Phone::class, ['number' => '777777777']);
        $newDate  = new DateTime('1995-05-05');

        $customer->setName('Jane');
        $customer->setRecipientName('Jane Recipient');
        $customer->setReceiverName('Jane Receiver');
        $customer->setEmail('jane@example.com');
        $customer->setAddress($address);
        $customer->setDateOfBirth($newDate);
        $customer->setDocuments([$document]);
        $customer->setPhones([$phone]);
        $customer->setStateRegistrationIndicator(StateRegistrationIndicatorEnum::fromValue('CONTRIBUINTE_ICMS'));
        $customer->setStateRegistration('sr-2');

        $this->assertSame('Jane', $customer->getName());
        $this->assertSame('Jane Recipient', $customer->getRecipientName());
        $this->assertSame('Jane Receiver', $customer->getReceiverName());
        $this->assertSame('jane@example.com', $customer->getEmail());
        $this->assertSame($address, $customer->getAddress());
        $this->assertSame($newDate, $customer->getDateOfBirth());
        $this->assertSame($document, $customer->getDocuments()[0]);
        $this->assertSame($phone, $customer->getPhones()[0]);
        $this->assertSame('sr-2', $customer->getStateRegistration());
    }
}
