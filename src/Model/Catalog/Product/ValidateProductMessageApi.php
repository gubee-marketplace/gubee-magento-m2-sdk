<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Enum\Catalog\Product\DomainEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class ValidateProductMessageApi extends AbstractModel
{
    protected ?string $domainId = null;

    protected ?DomainEnum $domain = null;

    protected ?string $code = null;

    protected ?string $validationMessage = null;

    public function __construct(
        ?string $domainId = null,
        DomainEnum|string|null $domain = null,
        ?string $code = null,
        ?string $validationMessage = null
    ) {
        if ($domainId !== null) {
            $this->setDomainId($domainId);
        }
        if ($domain !== null) {
            if (is_string($domain)) {
                $domain = DomainEnum::fromValue($domain);
            }
            $this->setDomain($domain);
        }
        if ($code !== null) {
            $this->setCode($code);
        }
        if ($validationMessage !== null) {
            $this->setValidationMessage($validationMessage);
        }
    }

    public function getDomainId(): ?string
    {
        return $this->domainId;
    }

    public function setDomainId(?string $domainId): self
    {
        $this->domainId = $domainId;
        return $this;
    }

    public function getDomain(): ?DomainEnum
    {
        return $this->domain;
    }

    public function setDomain(?DomainEnum $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getValidationMessage(): ?string
    {
        return $this->validationMessage;
    }

    public function setValidationMessage(?string $validationMessage): self
    {
        $this->validationMessage = $validationMessage;
        return $this;
    }
}
