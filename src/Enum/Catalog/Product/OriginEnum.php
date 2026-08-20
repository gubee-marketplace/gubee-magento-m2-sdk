<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product;

use Gubee\SDK\Enum\AbstractEnum;

class OriginEnum extends AbstractEnum
{
    private const NONE = 'NONE';

    private const NACIONAL_EXCETO_3_5 = 'NACIONAL_EXCETO_3_5';

    private const ESTRANGEIRA_IMPORTACAO_DIRETA_EXCETO_6 = 'ESTRANGEIRA_IMPORTACAO_DIRETA_EXCETO_6';

    private const ESTRANGEIRA_MERCADO_INTERNO_EXCETO_7 = 'ESTRANGEIRA_MERCADO_INTERNO_EXCETO_7';

    private const NACIONAL_COM_IMPORTACAO_SUPERIOR_40 = 'NACIONAL_COM_IMPORTACAO_SUPERIOR_40';

    private const NACIONAL_PROCESSO_PRODUTIVO_BASICO = 'NACIONAL_PROCESSO_PRODUTIVO_BASICO';

    private const NACIONAL_COM_IMPORTACAO_INFERIOR_40 = 'NACIONAL_COM_IMPORTACAO_INFERIOR_40';

    private const ESTRANGEIRA_IMPORTACAO_DIRETA_SEM_SIMILAR = 'ESTRANGEIRA_IMPORTACAO_DIRETA_SEM_SIMILAR';

    private const NACIONAL_COM_IMPORTACAO_SUPERIOR_70 = 'NACIONAL_COM_IMPORTACAO_SUPERIOR_70';

    private const ESTRANGEIRA_MERCADO_INTERNO_SEM_SIMILAR = 'ESTRANGEIRA_MERCADO_INTERNO_SEM_SIMILAR';

    public static function NONE(): self
    {
        return new self(self::NONE);
    }

    public static function NACIONAL_EXCETO_3_5(): self
    {
        return new self(self::NACIONAL_EXCETO_3_5);
    }

    public static function ESTRANGEIRA_IMPORTACAO_DIRETA_EXCETO_6(): self
    {
        return new self(self::ESTRANGEIRA_IMPORTACAO_DIRETA_EXCETO_6);
    }

    public static function ESTRANGEIRA_MERCADO_INTERNO_EXCETO_7(): self
    {
        return new self(self::ESTRANGEIRA_MERCADO_INTERNO_EXCETO_7);
    }

    public static function NACIONAL_COM_IMPORTACAO_SUPERIOR_40(): self
    {
        return new self(self::NACIONAL_COM_IMPORTACAO_SUPERIOR_40);
    }

    public static function NACIONAL_PROCESSO_PRODUTIVO_BASICO(): self
    {
        return new self(self::NACIONAL_PROCESSO_PRODUTIVO_BASICO);
    }

    public static function NACIONAL_COM_IMPORTACAO_INFERIOR_40(): self
    {
        return new self(self::NACIONAL_COM_IMPORTACAO_INFERIOR_40);
    }

    public static function ESTRANGEIRA_IMPORTACAO_DIRETA_SEM_SIMILAR(): self
    {
        return new self(self::ESTRANGEIRA_IMPORTACAO_DIRETA_SEM_SIMILAR);
    }

    public static function NACIONAL_COM_IMPORTACAO_SUPERIOR_70(): self
    {
        return new self(self::NACIONAL_COM_IMPORTACAO_SUPERIOR_70);
    }

    public static function ESTRANGEIRA_MERCADO_INTERNO_SEM_SIMILAR(): self
    {
        return new self(self::ESTRANGEIRA_MERCADO_INTERNO_SEM_SIMILAR);
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
