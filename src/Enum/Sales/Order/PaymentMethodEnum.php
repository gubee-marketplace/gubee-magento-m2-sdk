<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class PaymentMethodEnum extends AbstractEnum
{
    private const CASH = 'CASH';

    private const CHECK = 'CHECK';

    private const CREDIT_CARD = 'CREDIT_CARD';

    private const DEBIT_CARD = 'DEBIT_CARD';

    private const STORE_CARD = 'STORE_CARD';

    private const FOOD_VOUCHER = 'FOOD_VOUCHER';

    private const MEAL_VOUCHER = 'MEAL_VOUCHER';

    private const GIFT_VOUCHER = 'GIFT_VOUCHER';

    private const FUEL_VOUCHER = 'FUEL_VOUCHER';

    private const DUPLICATA = 'DUPLICATA';

    private const BOLETO = 'BOLETO';

    private const BANK_DEPOSIT = 'BANK_DEPOSIT';

    private const PIX_DYNAMIC = 'PIX_DYNAMIC';

    private const TRANSFER = 'TRANSFER';

    private const LOYALTY = 'LOYALTY';

    private const PIX_STATIC = 'PIX_STATIC';

    private const STORE_CREDIT = 'STORE_CREDIT';

    private const ELECTRONIC_FAILURE = 'ELECTRONIC_FAILURE';

    private const NO_PAYMENT = 'NO_PAYMENT';

    private const OTHER = 'OTHER';

    public static function CASH(): self
    {
        return new self(self::CASH);
    }

    public static function CHECK(): self
    {
        return new self(self::CHECK);
    }

    public static function CREDIT_CARD(): self
    {
        return new self(self::CREDIT_CARD);
    }

    public static function DEBIT_CARD(): self
    {
        return new self(self::DEBIT_CARD);
    }

    public static function STORE_CARD(): self
    {
        return new self(self::STORE_CARD);
    }

    public static function FOOD_VOUCHER(): self
    {
        return new self(self::FOOD_VOUCHER);
    }

    public static function MEAL_VOUCHER(): self
    {
        return new self(self::MEAL_VOUCHER);
    }

    public static function GIFT_VOUCHER(): self
    {
        return new self(self::GIFT_VOUCHER);
    }

    public static function FUEL_VOUCHER(): self
    {
        return new self(self::FUEL_VOUCHER);
    }

    public static function DUPLICATA(): self
    {
        return new self(self::DUPLICATA);
    }

    public static function BOLETO(): self
    {
        return new self(self::BOLETO);
    }

    public static function BANK_DEPOSIT(): self
    {
        return new self(self::BANK_DEPOSIT);
    }

    public static function PIX_DYNAMIC(): self
    {
        return new self(self::PIX_DYNAMIC);
    }

    public static function TRANSFER(): self
    {
        return new self(self::TRANSFER);
    }

    public static function LOYALTY(): self
    {
        return new self(self::LOYALTY);
    }

    public static function PIX_STATIC(): self
    {
        return new self(self::PIX_STATIC);
    }

    public static function STORE_CREDIT(): self
    {
        return new self(self::STORE_CREDIT);
    }

    public static function ELECTRONIC_FAILURE(): self
    {
        return new self(self::ELECTRONIC_FAILURE);
    }

    public static function NO_PAYMENT(): self
    {
        return new self(self::NO_PAYMENT);
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
