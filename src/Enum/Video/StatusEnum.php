<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Video;

use Gubee\SDK\Enum\AbstractEnum;

class StatusEnum extends AbstractEnum
{
    private const PENDING_UPLOAD = 'PENDING_UPLOAD';

    private const UPLOADED = 'UPLOADED';

    private const PROCESSING = 'PROCESSING';

    private const READY = 'READY';

    private const FAILED = 'FAILED';

    private const EXPIRED = 'EXPIRED';

    private const DELETED = 'DELETED';

    public static function PENDING_UPLOAD(): self
    {
        return new self(self::PENDING_UPLOAD);
    }

    public static function UPLOADED(): self
    {
        return new self(self::UPLOADED);
    }

    public static function PROCESSING(): self
    {
        return new self(self::PROCESSING);
    }

    public static function READY(): self
    {
        return new self(self::READY);
    }

    public static function FAILED(): self
    {
        return new self(self::FAILED);
    }

    public static function EXPIRED(): self
    {
        return new self(self::EXPIRED);
    }

    public static function DELETED(): self
    {
        return new self(self::DELETED);
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
