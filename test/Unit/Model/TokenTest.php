<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    private function buildToken(): Token
    {
        return new Token(
            'id-1',
            'login-1',
            false,
            'seller-1',
            'token-1',
            'Bearer',
            '2026-07-12T10:00:00.000'
        );
    }

    public function testConstructorParsesStringValidity(): void
    {
        $token = $this->buildToken();

        $this->assertSame('id-1', $token->getId());
        $this->assertSame('login-1', $token->getLogin());
        $this->assertFalse($token->getRevoked());
        $this->assertSame('seller-1', $token->getSellerId());
        $this->assertSame('token-1', $token->getToken());
        $this->assertSame('Bearer', $token->getTokenType());
        $this->assertInstanceOf(DateTimeInterface::class, $token->getValidity());
        $this->assertSame('2026-07-12', $token->getValidity()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterfaceValidity(): void
    {
        $validity = new DateTime('2026-01-01');

        $token = new Token('id', 'login', true, 'seller', 'tok', 'Bearer', $validity);

        $this->assertSame($validity, $token->getValidity());
    }

    public function testSetters(): void
    {
        $token = $this->buildToken();

        $token->setId('id-2');
        $token->setLogin('login-2');
        $token->setRevoked(true);
        $token->setSellerId('seller-2');
        $token->setToken('token-2');
        $token->setTokenType('Basic');

        $this->assertSame('id-2', $token->getId());
        $this->assertSame('login-2', $token->getLogin());
        $this->assertTrue($token->getRevoked());
        $this->assertSame('seller-2', $token->getSellerId());
        $this->assertSame('token-2', $token->getToken());
        $this->assertSame('Basic', $token->getTokenType());
    }

    public function testSetValidityAcceptsString(): void
    {
        $token = $this->buildToken();

        $token->setValidity('2027-05-05T00:00:00.000');

        $this->assertSame('2027-05-05', $token->getValidity()->format('Y-m-d'));
    }

    public function testSetValidityAcceptsDateTimeInterface(): void
    {
        $token    = $this->buildToken();
        $validity = new DateTime('2028-01-01');

        $token->setValidity($validity);

        $this->assertSame($validity, $token->getValidity());
    }
}
