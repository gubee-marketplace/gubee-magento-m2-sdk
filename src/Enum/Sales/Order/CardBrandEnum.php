<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class CardBrandEnum extends AbstractEnum
{
    private const VISA = 'VISA';

    private const MASTERCARD = 'MASTERCARD';

    private const AMEX = 'AMEX';

    private const SOROCRED = 'SOROCRED';

    private const DINERS = 'DINERS';

    private const ELO = 'ELO';

    private const HIPERCARD = 'HIPERCARD';

    private const AURA = 'AURA';

    private const CABAL = 'CABAL';

    private const ALELO = 'ALELO';

    private const BANESCARD = 'BANESCARD';

    private const CALCARD = 'CALCARD';

    private const CREDZ = 'CREDZ';

    private const DISCOVER = 'DISCOVER';

    private const GOODCARD = 'GOODCARD';

    private const GREENCARD = 'GREENCARD';

    private const HIPER = 'HIPER';

    private const JCB = 'JCB';

    private const MAIS = 'MAIS';

    private const MAXVAN = 'MAXVAN';

    private const POLICARD = 'POLICARD';

    private const REDECOMPRAS = 'REDECOMPRAS';

    private const SODEXO = 'SODEXO';

    private const VALECARD = 'VALECARD';

    private const VEROCHEQUE = 'VEROCHEQUE';

    private const VR = 'VR';

    private const TICKET = 'TICKET';

    private const OTHER = 'OTHER';

    public static function VISA(): self
    {
        return new self(self::VISA);
    }

    public static function MASTERCARD(): self
    {
        return new self(self::MASTERCARD);
    }

    public static function AMEX(): self
    {
        return new self(self::AMEX);
    }

    public static function SOROCRED(): self
    {
        return new self(self::SOROCRED);
    }

    public static function DINERS(): self
    {
        return new self(self::DINERS);
    }

    public static function ELO(): self
    {
        return new self(self::ELO);
    }

    public static function HIPERCARD(): self
    {
        return new self(self::HIPERCARD);
    }

    public static function AURA(): self
    {
        return new self(self::AURA);
    }

    public static function CABAL(): self
    {
        return new self(self::CABAL);
    }

    public static function ALELO(): self
    {
        return new self(self::ALELO);
    }

    public static function BANESCARD(): self
    {
        return new self(self::BANESCARD);
    }

    public static function CALCARD(): self
    {
        return new self(self::CALCARD);
    }

    public static function CREDZ(): self
    {
        return new self(self::CREDZ);
    }

    public static function DISCOVER(): self
    {
        return new self(self::DISCOVER);
    }

    public static function GOODCARD(): self
    {
        return new self(self::GOODCARD);
    }

    public static function GREENCARD(): self
    {
        return new self(self::GREENCARD);
    }

    public static function HIPER(): self
    {
        return new self(self::HIPER);
    }

    public static function JCB(): self
    {
        return new self(self::JCB);
    }

    public static function MAIS(): self
    {
        return new self(self::MAIS);
    }

    public static function MAXVAN(): self
    {
        return new self(self::MAXVAN);
    }

    public static function POLICARD(): self
    {
        return new self(self::POLICARD);
    }

    public static function REDECOMPRAS(): self
    {
        return new self(self::REDECOMPRAS);
    }

    public static function SODEXO(): self
    {
        return new self(self::SODEXO);
    }

    public static function VALECARD(): self
    {
        return new self(self::VALECARD);
    }

    public static function VEROCHEQUE(): self
    {
        return new self(self::VEROCHEQUE);
    }

    public static function VR(): self
    {
        return new self(self::VR);
    }

    public static function TICKET(): self
    {
        return new self(self::TICKET);
    }

    public static function OTHER(): self
    {
        return new self(self::OTHER);
    }

    /**
     * Create a new instance of the enum based into a given value
     *
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
