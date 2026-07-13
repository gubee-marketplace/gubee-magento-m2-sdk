<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\GenderEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Common\Document;
use Gubee\SDK\Model\Common\Phone;

use function is_array;
use function is_string;

class OrderCustomerApi extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $recipientName = null;

    protected ?string $receiverName = null;

    protected ?string $email = null;

    protected ?string $dateOfBirth = null;

    protected ?GenderEnum $gender = null;

    /** @var array<Document> */

    protected array $documents;

    /** @var array<Phone> */

    protected array $phones;

    /**
     * @param array<Document|array<mixed>> $documents
     * @param array<Phone|array<mixed>> $phones
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $name = null,
        ?string $recipientName = null,
        ?string $receiverName = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        GenderEnum|string|null $gender = null,
        array $documents,
        array $phones
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
        if ($dateOfBirth !== null) {
            $this->setDateOfBirth($dateOfBirth);
        }
        if ($gender !== null) {
            if (is_string($gender)) {
                $gender = GenderEnum::fromValue($gender);
            }
            $this->setGender($gender);
        }
        foreach ($documents as $key => $value) {
            if (is_array($value)) {
                $documents[$key] = $serviceProvider->create(
                    Document::class,
                    $value
                );
            }
        }
        $this->setDocuments($documents);
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

    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?string $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function getGender(): ?GenderEnum
    {
        return $this->gender;
    }

    public function setGender(?GenderEnum $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return array<Document>
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @param array<Document> $documents
     */
    public function setDocuments(array $documents): self
    {
        $this->validateArrayElements($documents, Document::class);
        $this->documents = $documents;
        return $this;
    }

    /**
     * @return array<Phone>
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param array<Phone> $phones
     */
    public function setPhones(array $phones): self
    {
        $this->validateArrayElements($phones, Phone::class);
        $this->phones = $phones;
        return $this;
    }
}
