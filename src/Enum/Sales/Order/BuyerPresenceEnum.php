<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class BuyerPresenceEnum extends AbstractEnum
{
    private const NOT_APPLICABLE = 'NOT_APPLICABLE';

    private const IN_PERSON_OPERATION = 'IN_PERSON_OPERATION';

    private const REMOTE_OPERATION_INTERNET = 'REMOTE_OPERATION_INTERNET';

    private const REMOTE_OPERATION_TELEPHONE = 'REMOTE_OPERATION_TELEPHONE';

    private const NFC_E_HOME_DELIVERY = 'NFC_E_HOME_DELIVERY';

    private const IN_PERSON_OUTSIDE_ESTABLISHMENT = 'IN_PERSON_OUTSIDE_ESTABLISHMENT';

    private const REMOTE_OPERATION_OTHER = 'REMOTE_OPERATION_OTHER';

    public static function NOT_APPLICABLE(): self
    {
        return new self(self::NOT_APPLICABLE);
    }

    public static function IN_PERSON_OPERATION(): self
    {
        return new self(self::IN_PERSON_OPERATION);
    }

    public static function REMOTE_OPERATION_INTERNET(): self
    {
        return new self(self::REMOTE_OPERATION_INTERNET);
    }

    public static function REMOTE_OPERATION_TELEPHONE(): self
    {
        return new self(self::REMOTE_OPERATION_TELEPHONE);
    }

    public static function NFC_E_HOME_DELIVERY(): self
    {
        return new self(self::NFC_E_HOME_DELIVERY);
    }

    public static function IN_PERSON_OUTSIDE_ESTABLISHMENT(): self
    {
        return new self(self::IN_PERSON_OUTSIDE_ESTABLISHMENT);
    }

    public static function REMOTE_OPERATION_OTHER(): self
    {
        return new self(self::REMOTE_OPERATION_OTHER);
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
