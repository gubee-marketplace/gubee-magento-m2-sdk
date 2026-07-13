<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Tag;

use Gubee\SDK\Model\AbstractModel;

class UngroupTagsResponseApi extends AbstractModel
{
    protected string $groupId;

    /** @var array<string> */

    protected array $ungroupedOrders;

    protected ?string $message = null;

    protected ?array $parameters = null;

    /**
     * @param array<string> $ungroupedOrders
     */
    public function __construct(
        string $groupId,
        array $ungroupedOrders,
        ?string $message = null,
        ?array $parameters = null
    ) {
        $this->setGroupId($groupId);
        $this->setUngroupedOrders($ungroupedOrders);
        if ($message !== null) {
            $this->setMessage($message);
        }
        if ($parameters !== null) {
            $this->setParameters($parameters);
        }
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function setGroupId(string $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getUngroupedOrders(): array
    {
        return $this->ungroupedOrders;
    }

    /**
     * @param array<string> $ungroupedOrders
     */
    public function setUngroupedOrders(array $ungroupedOrders): self
    {
        $this->validateArrayElements($ungroupedOrders, 'string');
        $this->ungroupedOrders = $ungroupedOrders;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function setParameters(?array $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }
}
