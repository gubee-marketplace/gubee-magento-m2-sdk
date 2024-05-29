<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\AbstractModel;

abstract class AbstractMedia extends AbstractModel
{
    protected bool $main = false;
    protected int $order;
    protected ?string $id   = null;
    protected ?string $name = null;
    protected ?string $url  = null;

    public function __construct(
        bool $main,
        int $order,
        ?string $id = null,
        ?string $name = null,
        ?string $url = null
    ) {
        $this->main  = $main;
        $this->order = $order;
        if ($id !== null) {
            $this->setId($id);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($url !== null) {
            $this->setUrl($url);
        }
    }

    public function getMain(): bool
    {
        return $this->main;
    }

    public function setMain(bool $main)
    {
        $this->main = $main;
        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order)
    {
        $this->order = $order;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }
}
