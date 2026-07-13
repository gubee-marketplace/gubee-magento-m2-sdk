<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class Link extends AbstractModel
{
    protected ?string $href = null;

    protected ?string $hreflang = null;

    protected ?string $title = null;

    protected ?string $type = null;

    protected ?string $deprecation = null;

    protected ?string $profile = null;

    protected ?string $name = null;

    protected ?bool $templated = null;

    public function __construct(
        ?string $href = null,
        ?string $hreflang = null,
        ?string $title = null,
        ?string $type = null,
        ?string $deprecation = null,
        ?string $profile = null,
        ?string $name = null,
        ?bool $templated = null
    ) {
        if ($href !== null) {
            $this->setHref($href);
        }
        if ($hreflang !== null) {
            $this->setHreflang($hreflang);
        }
        if ($title !== null) {
            $this->setTitle($title);
        }
        if ($type !== null) {
            $this->setType($type);
        }
        if ($deprecation !== null) {
            $this->setDeprecation($deprecation);
        }
        if ($profile !== null) {
            $this->setProfile($profile);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($templated !== null) {
            $this->setTemplated($templated);
        }
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function setHref(?string $href): self
    {
        $this->href = $href;
        return $this;
    }

    public function getHreflang(): ?string
    {
        return $this->hreflang;
    }

    public function setHreflang(?string $hreflang): self
    {
        $this->hreflang = $hreflang;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getDeprecation(): ?string
    {
        return $this->deprecation;
    }

    public function setDeprecation(?string $deprecation): self
    {
        $this->deprecation = $deprecation;
        return $this;
    }

    public function getProfile(): ?string
    {
        return $this->profile;
    }

    public function setProfile(?string $profile): self
    {
        $this->profile = $profile;
        return $this;
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

    public function getTemplated(): ?bool
    {
        return $this->templated;
    }

    public function setTemplated(?bool $templated): self
    {
        $this->templated = $templated;
        return $this;
    }
}
