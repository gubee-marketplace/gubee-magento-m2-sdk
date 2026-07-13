<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Notification;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;

class MissedNotification extends AbstractModel
{
    protected string $id;

    protected string $resource;

    protected string $sellerId;

    protected string $domain;

    protected string $endpointId;

    protected string $type;

    protected int $attempts;

    protected ?DateTimeInterface $lastAttemptDateTime = null;

    protected ?NotificationRequestApi $request = null;

    protected ?NotificationResponseApi $response = null;

    /** @var array<string, mixed>|null */
    protected ?array $links = null;

    /**
     * @param NotificationRequestApi|array<string, mixed>|null $request
     * @param NotificationResponseApi|array<string, mixed>|null $response
     * @param array<string, mixed>|null $links
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $id,
        string $resource,
        string $sellerId,
        string $domain,
        string $endpointId,
        string $type,
        int $attempts,
        DateTimeInterface|string|null $lastAttemptDateTime = null,
        $request = null,
        $response = null,
        ?array $_links = null
    ) {
        $this->setId($id);
        $this->setResource($resource);
        $this->setSellerId($sellerId);
        $this->setDomain($domain);
        $this->setEndpointId($endpointId);
        $this->setType($type);
        $this->setAttempts($attempts);

        if ($lastAttemptDateTime !== null) {
            if (! $lastAttemptDateTime instanceof DateTimeInterface) {
                $lastAttemptDateTime = new DateTime($lastAttemptDateTime);
            }
            $this->setLastAttemptDateTime($lastAttemptDateTime);
        }

        $data = $this->hydrate(
            $serviceProvider,
            [
                'request'  => $request,
                'response' => $response,
            ],
            [
                'request'  => NotificationRequestApi::class,
                'response' => NotificationResponseApi::class,
            ]
        );

        if ($data['request'] !== null) {
            $this->setRequest($data['request']);
        }
        if ($data['response'] !== null) {
            $this->setResponse($data['response']);
        }
        if ($_links !== null) {
            $this->setLinks($_links);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    public function setSellerId(string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function getEndpointId(): string
    {
        return $this->endpointId;
    }

    public function setEndpointId(string $endpointId): self
    {
        $this->endpointId = $endpointId;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function setAttempts(int $attempts): self
    {
        $this->attempts = $attempts;
        return $this;
    }

    public function getLastAttemptDateTime(): ?DateTimeInterface
    {
        return $this->lastAttemptDateTime;
    }

    public function setLastAttemptDateTime(?DateTimeInterface $lastAttemptDateTime): self
    {
        $this->lastAttemptDateTime = $lastAttemptDateTime;
        return $this;
    }

    public function getRequest(): ?NotificationRequestApi
    {
        return $this->request;
    }

    public function setRequest(?NotificationRequestApi $request): self
    {
        $this->request = $request;
        return $this;
    }

    public function getResponse(): ?NotificationResponseApi
    {
        return $this->response;
    }

    public function setResponse(?NotificationResponseApi $response): self
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getLinks(): ?array
    {
        return $this->links;
    }

    /**
     * @param array<string, mixed>|null $links
     */
    public function setLinks(?array $links): self
    {
        $this->links = $links;
        return $this;
    }
}
