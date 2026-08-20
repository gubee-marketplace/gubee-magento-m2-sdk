<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class PlatformEnum extends AbstractEnum
{
    private const HUBEE = 'HUBEE';

    private const MAGENTO = 'MAGENTO';

    private const BIS2BIS = 'BIS2BIS';

    private const ALTERNATIVA = 'ALTERNATIVA';

    private const BLING = 'BLING';

    private const TINY = 'TINY';

    private const CONTAAZUL = 'CONTAAZUL';

    private const B2W = 'B2W';

    private const CNOVA = 'CNOVA';

    private const CARREFOUR = 'CARREFOUR';

    private const MAGAZINELUIZA = 'MAGAZINELUIZA';

    private const GFG = 'GFG';

    private const NETSHOES = 'NETSHOES';

    private const AMAZON = 'AMAZON';

    private const MOBLY = 'MOBLY';

    private const CENTAURO = 'CENTAURO';

    private const SHOPFACIL = 'SHOPFACIL';

    private const ELO7 = 'ELO7';

    private const ZOOM = 'ZOOM';

    private const BUSCAPE = 'BUSCAPE';

    private const CONNECTPARTS = 'CONNECTPARTS';

    private const FASTSHOP = 'FASTSHOP';

    private const LOJASCOLOMBO = 'LOJASCOLOMBO';

    private const WEBCONTINENTAL = 'WEBCONTINENTAL';

    private const MADEIRAMADEIRA = 'MADEIRAMADEIRA';

    private const LEROYMERLIN = 'LEROYMERLIN';

    private const MERCADOLIVRE = 'MERCADOLIVRE';

    private const SHOPEE = 'SHOPEE';

    private const ALIEXPRESS = 'ALIEXPRESS';

    private const SHEIN = 'SHEIN';

    private const AMAZONV2 = 'AMAZONV2';

    private const TEMU = 'TEMU';

    private const VTEX = 'VTEX';

    private const KABUM = 'KABUM';

    private const CARREFOURV2 = 'CARREFOURV2';

    private const MAGALU = 'MAGALU';

    private const LEROYMERLINV2 = 'LEROYMERLINV2';

    private const TIKTOKSHOP = 'TIKTOKSHOP';

    private const MADEIRAMADEIRAV2 = 'MADEIRAMADEIRAV2';

    private const VIAVAREJO = 'VIAVAREJO';

    private const CORREIOSLOGISTICS = 'CORREIOSLOGISTICS';

    private const INTELIPOSTLOGISTICS = 'INTELIPOSTLOGISTICS';

    private const GUBEE_STORE = 'GUBEE_STORE';

    public static function HUBEE(): self
    {
        return new self(self::HUBEE);
    }

    public static function MAGENTO(): self
    {
        return new self(self::MAGENTO);
    }

    public static function BIS2BIS(): self
    {
        return new self(self::BIS2BIS);
    }

    public static function ALTERNATIVA(): self
    {
        return new self(self::ALTERNATIVA);
    }

    public static function BLING(): self
    {
        return new self(self::BLING);
    }

    public static function TINY(): self
    {
        return new self(self::TINY);
    }

    public static function CONTAAZUL(): self
    {
        return new self(self::CONTAAZUL);
    }

    public static function B2W(): self
    {
        return new self(self::B2W);
    }

    public static function CNOVA(): self
    {
        return new self(self::CNOVA);
    }

    public static function CARREFOUR(): self
    {
        return new self(self::CARREFOUR);
    }

    public static function MAGAZINELUIZA(): self
    {
        return new self(self::MAGAZINELUIZA);
    }

    public static function GFG(): self
    {
        return new self(self::GFG);
    }

    public static function NETSHOES(): self
    {
        return new self(self::NETSHOES);
    }

    public static function AMAZON(): self
    {
        return new self(self::AMAZON);
    }

    public static function MOBLY(): self
    {
        return new self(self::MOBLY);
    }

    public static function CENTAURO(): self
    {
        return new self(self::CENTAURO);
    }

    public static function SHOPFACIL(): self
    {
        return new self(self::SHOPFACIL);
    }

    public static function ELO7(): self
    {
        return new self(self::ELO7);
    }

    public static function ZOOM(): self
    {
        return new self(self::ZOOM);
    }

    public static function BUSCAPE(): self
    {
        return new self(self::BUSCAPE);
    }

    public static function CONNECTPARTS(): self
    {
        return new self(self::CONNECTPARTS);
    }

    public static function FASTSHOP(): self
    {
        return new self(self::FASTSHOP);
    }

    public static function LOJASCOLOMBO(): self
    {
        return new self(self::LOJASCOLOMBO);
    }

    public static function WEBCONTINENTAL(): self
    {
        return new self(self::WEBCONTINENTAL);
    }

    public static function MADEIRAMADEIRA(): self
    {
        return new self(self::MADEIRAMADEIRA);
    }

    public static function LEROYMERLIN(): self
    {
        return new self(self::LEROYMERLIN);
    }

    public static function MERCADOLIVRE(): self
    {
        return new self(self::MERCADOLIVRE);
    }

    public static function SHOPEE(): self
    {
        return new self(self::SHOPEE);
    }

    public static function ALIEXPRESS(): self
    {
        return new self(self::ALIEXPRESS);
    }

    public static function SHEIN(): self
    {
        return new self(self::SHEIN);
    }

    public static function AMAZONV2(): self
    {
        return new self(self::AMAZONV2);
    }

    public static function TEMU(): self
    {
        return new self(self::TEMU);
    }

    public static function VTEX(): self
    {
        return new self(self::VTEX);
    }

    public static function KABUM(): self
    {
        return new self(self::KABUM);
    }

    public static function CARREFOURV2(): self
    {
        return new self(self::CARREFOURV2);
    }

    public static function MAGALU(): self
    {
        return new self(self::MAGALU);
    }

    public static function LEROYMERLINV2(): self
    {
        return new self(self::LEROYMERLINV2);
    }

    public static function TIKTOKSHOP(): self
    {
        return new self(self::TIKTOKSHOP);
    }

    public static function MADEIRAMADEIRAV2(): self
    {
        return new self(self::MADEIRAMADEIRAV2);
    }

    public static function VIAVAREJO(): self
    {
        return new self(self::VIAVAREJO);
    }

    public static function CORREIOSLOGISTICS(): self
    {
        return new self(self::CORREIOSLOGISTICS);
    }

    public static function INTELIPOSTLOGISTICS(): self
    {
        return new self(self::INTELIPOSTLOGISTICS);
    }

    public static function GUBEE_STORE(): self
    {
        return new self(self::GUBEE_STORE);
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
