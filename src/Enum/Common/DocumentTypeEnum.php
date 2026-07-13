<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Common;

use Gubee\SDK\Enum\AbstractEnum;

class DocumentTypeEnum extends AbstractEnum
{
    private const CPF  = 'CPF';
    private const CNPJ = 'CNPJ';
    private const RG   = 'RG';
    private const IE   = 'IE';

    public static function CPF(): self
    {
        return new self(self::CPF);
    }

    public static function CNPJ(): self
    {
        return new self(self::CNPJ);
    }

    public static function RG(): self
    {
        return new self(self::RG);
    }

    public static function IE(): self
    {
        return new self(self::IE);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
