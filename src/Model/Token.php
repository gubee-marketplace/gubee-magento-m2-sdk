<?php

declare(strict_types=1);

namespace Gubee\SDK\Model;

use DateTime;
use DateTimeInterface;

class Token extends AbstractModel
{
    protected string $id;
    protected string $login;
    protected bool $revoked;
    protected string $sellerId;
    protected string $token;
    protected string $tokenType;
    protected DateTimeInterface $validity;

    /**
     * Summary of __construct
     *
     * @param string|DateTimeInterface $validity
     */
    public function __construct(
        string $id,
        string $login,
        bool $revoked,
        string $sellerId,
        string $token,
        string $tokenType,
        $validity
    ) {
        $this->id        = $id;
        $this->login     = $login;
        $this->revoked   = $revoked;
        $this->sellerId  = $sellerId;
        $this->token     = $token;
        $this->tokenType = $tokenType;
        if (! $validity instanceof DateTimeInterface) {
            $this->validity = DateTime::createFromFormat(
                'Y-m-d\TH:i:s.v',
                $validity
            );
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

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getRevoked(): bool
    {
        return $this->revoked;
    }

    public function setRevoked(bool $revoked): self
    {
        $this->revoked = $revoked;
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

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function setTokenType(string $tokenType): self
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    public function getValidity(): DateTimeInterface
    {
        return $this->validity;
    }

    /**
     * Set the validity of the token.
     *
     * @param string|DateTimeInterface $validity
     * @return Token
     */
    public function setValidity($validity): self
    {
        if (! $validity instanceof DateTimeInterface) {
            $validity = DateTime::createFromFormat(
                'Y-m-d\TH:i:s.v',
                $validity
            );
        }

        $this->validity = $validity;
        return $this;
    }
}
