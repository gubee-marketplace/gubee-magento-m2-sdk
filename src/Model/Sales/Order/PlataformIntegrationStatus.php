<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\PlatformIntegrationStatusEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Notification\IntegrationNotification;
use Gubee\SDK\Model\Platform\SetUp;

use function is_array;
use function is_string;

class PlataformIntegrationStatus extends AbstractModel
{
    protected ?string $plataform = null;

    /** @var array<IntegrationNotification>|null */

    protected ?array $errors = null;

    /** @var array<IntegrationNotification>|null */

    protected ?array $notifications = null;

    protected ?string $partnerStatus = null;

    protected ?DateTimeInterface $lastModifiedDt = null;

    protected ?PlatformIntegrationStatusEnum $status = null;

    protected ?string $eventId = null;

    protected ?string $platform = null;

    protected ?SetUp $up = null;

    /**
     * @param array<IntegrationNotification|array<mixed>>|null $errors
     * @param array<IntegrationNotification|array<mixed>>|null $notifications
     * @param SetUp|array<mixed>|null $up
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $plataform = null,
        ?array $errors = null,
        ?array $notifications = null,
        ?string $partnerStatus = null,
        DateTimeInterface|string|null $lastModifiedDt = null,
        PlatformIntegrationStatusEnum|string|null $status = null,
        ?string $eventId = null,
        ?string $platform = null,
        SetUp|array|null $up = null
    ) {
        if ($plataform !== null) {
            $this->setPlataform($plataform);
        }
        if ($errors !== null) {
            foreach ($errors as $key => $value) {
                if (is_array($value)) {
                    $errors[$key] = $serviceProvider->create(
                        IntegrationNotification::class,
                        $value
                    );
                }
            }
            $this->setErrors($errors);
        }
        if ($notifications !== null) {
            foreach ($notifications as $key => $value) {
                if (is_array($value)) {
                    $notifications[$key] = $serviceProvider->create(
                        IntegrationNotification::class,
                        $value
                    );
                }
            }
            $this->setNotifications($notifications);
        }
        if ($partnerStatus !== null) {
            $this->setPartnerStatus($partnerStatus);
        }
        if ($lastModifiedDt !== null) {
            if (! $lastModifiedDt instanceof DateTimeInterface) {
                $lastModifiedDt = new DateTime($lastModifiedDt);
            }
            $this->setLastModifiedDt($lastModifiedDt);
        }
        if ($status !== null) {
            if (is_string($status)) {
                $status = PlatformIntegrationStatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }
        if ($eventId !== null) {
            $this->setEventId($eventId);
        }
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($up !== null) {
            if (is_array($up)) {
                $up = $serviceProvider->create(
                    SetUp::class,
                    $up
                );
            }
            $this->setUp($up);
        }
    }

    public function getPlataform(): ?string
    {
        return $this->plataform;
    }

    public function setPlataform(?string $plataform): self
    {
        $this->plataform = $plataform;
        return $this;
    }

    /**
     * @return array<IntegrationNotification>|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param array<IntegrationNotification> $errors
     */
    public function setErrors(?array $errors): self
    {
        if ($errors !== null) {
            $this->validateArrayElements($errors, IntegrationNotification::class);
        }
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return array<IntegrationNotification>|null
     */
    public function getNotifications(): ?array
    {
        return $this->notifications;
    }

    /**
     * @param array<IntegrationNotification> $notifications
     */
    public function setNotifications(?array $notifications): self
    {
        if ($notifications !== null) {
            $this->validateArrayElements($notifications, IntegrationNotification::class);
        }
        $this->notifications = $notifications;
        return $this;
    }

    public function getPartnerStatus(): ?string
    {
        return $this->partnerStatus;
    }

    public function setPartnerStatus(?string $partnerStatus): self
    {
        $this->partnerStatus = $partnerStatus;
        return $this;
    }

    public function getLastModifiedDt(): ?DateTimeInterface
    {
        return $this->lastModifiedDt;
    }

    public function setLastModifiedDt(?DateTimeInterface $lastModifiedDt): self
    {
        $this->lastModifiedDt = $lastModifiedDt;
        return $this;
    }

    public function getStatus(): ?PlatformIntegrationStatusEnum
    {
        return $this->status;
    }

    public function setStatus(?PlatformIntegrationStatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getEventId(): ?string
    {
        return $this->eventId;
    }

    public function setEventId(?string $eventId): self
    {
        $this->eventId = $eventId;
        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getUp(): ?SetUp
    {
        return $this->up;
    }

    public function setUp(?SetUp $up): self
    {
        $this->up = $up;
        return $this;
    }
}
