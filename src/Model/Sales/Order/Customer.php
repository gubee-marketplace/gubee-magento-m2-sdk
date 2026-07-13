<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Common\StateRegistrationIndicatorEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Common\Document;
use Gubee\SDK\Model\Common\Phone;

use function is_array;
use function is_string;

class Customer extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $recipientName = null;

    protected ?string $receiverName = null;

    protected ?string $email = null;

    protected ?Address $address = null;

    protected ?DateTimeInterface $dateOfBirth = null;

    /** @var array<Document>|null */

    protected ?array $documents = null;

    /** @var array<Phone>|null */

    protected ?array $phones = null;

    protected ?StateRegistrationIndicatorEnum $stateRegistrationIndicator = null;

    protected ?string $stateRegistration = null;

    /**
     * @param Address|array<mixed>|null $address
     * @param array<Document|array<mixed>>|null $documents
     * @param array<Phone|array<mixed>>|null $phones
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $name = null,
        ?string $recipientName = null,
        ?string $receiverName = null,
        ?string $email = null,
        Address|array|null $address = null,
        DateTimeInterface|string|null $dateOfBirth = null,
        ?array $documents = null,
        ?array $phones = null,
        StateRegistrationIndicatorEnum|string|null $stateRegistrationIndicator = null,
        ?string $stateRegistration = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($recipientName !== null) {
            $this->setRecipientName($recipientName);
        }
        if ($receiverName !== null) {
            $this->setReceiverName($receiverName);
        }
        if ($email !== null) {
            $this->setEmail($email);
        }
        if ($address !== null) {
            if (is_array($address)) {
                $address = $serviceProvider->create(
                    Address::class,
                    $address
                );
            }
            $this->setAddress($address);
        }
        if ($dateOfBirth !== null) {
            if (! $dateOfBirth instanceof DateTimeInterface) {
                $dateOfBirth = new DateTime($dateOfBirth);
            }
            $this->setDateOfBirth($dateOfBirth);
        }
        if ($documents !== null) {
            foreach ($documents as $key => $value) {
                if (is_array($value)) {
                    $documents[$key] = $serviceProvider->create(
                        Document::class,
                        $value
                    );
                }
            }
            $this->setDocuments($documents);
        }
        if ($phones !== null) {
            foreach ($phones as $key => $value) {
                if (is_array($value)) {
                    $phones[$key] = $serviceProvider->create(
                        Phone::class,
                        $value
                    );
                }
            }
            $this->setPhones($phones);
        }
        if ($stateRegistrationIndicator !== null) {
            if (is_string($stateRegistrationIndicator)) {
                $stateRegistrationIndicator = StateRegistrationIndicatorEnum::fromValue($stateRegistrationIndicator);
            }
            $this->setStateRegistrationIndicator($stateRegistrationIndicator);
        }
        if ($stateRegistration !== null) {
            $this->setStateRegistration($stateRegistration);
        }
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getRecipientName(): ?string
    {
        return $this->recipientName;
    }

    public function setRecipientName(?string $recipientName): self
    {
        $this->recipientName = $recipientName;
        return $this;
    }

    public function getReceiverName(): ?string
    {
        return $this->receiverName;
    }

    public function setReceiverName(?string $receiverName): self
    {
        $this->receiverName = $receiverName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getDateOfBirth(): ?DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return array<Document>|null
     */
    public function getDocuments(): ?array
    {
        return $this->documents;
    }

    /**
     * @param array<Document> $documents
     */
    public function setDocuments(?array $documents): self
    {
        if ($documents !== null) {
            $this->validateArrayElements($documents, Document::class);
        }
        $this->documents = $documents;
        return $this;
    }

    /**
     * @return array<Phone>|null
     */
    public function getPhones(): ?array
    {
        return $this->phones;
    }

    /**
     * @param array<Phone> $phones
     */
    public function setPhones(?array $phones): self
    {
        if ($phones !== null) {
            $this->validateArrayElements($phones, Phone::class);
        }
        $this->phones = $phones;
        return $this;
    }

    public function getStateRegistrationIndicator(): ?StateRegistrationIndicatorEnum
    {
        return $this->stateRegistrationIndicator;
    }

    public function setStateRegistrationIndicator(?StateRegistrationIndicatorEnum $stateRegistrationIndicator): self
    {
        $this->stateRegistrationIndicator = $stateRegistrationIndicator;
        return $this;
    }

    public function getStateRegistration(): ?string
    {
        return $this->stateRegistration;
    }

    public function setStateRegistration(?string $stateRegistration): self
    {
        $this->stateRegistration = $stateRegistration;
        return $this;
    }
}
