<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Video;

use Gubee\SDK\Enum\AbstractEnum;

class FailureReasonEnum extends AbstractEnum
{
    private const PROBE_FAILED = 'PROBE_FAILED';

    private const UNSUPPORTED_CODEC = 'UNSUPPORTED_CODEC';

    private const EXCEEDS_DURATION = 'EXCEEDS_DURATION';

    private const EXCEEDS_SIZE = 'EXCEEDS_SIZE';

    private const INVALID_DIMENSIONS = 'INVALID_DIMENSIONS';

    private const TRANSCODE_TIMEOUT = 'TRANSCODE_TIMEOUT';

    private const TRANSCODE_FAILED = 'TRANSCODE_FAILED';

    private const UPLOAD_TO_BUCKET_FAILED = 'UPLOAD_TO_BUCKET_FAILED';

    private const INTERNAL_ERROR = 'INTERNAL_ERROR';

    public static function PROBE_FAILED(): self
    {
        return new self(self::PROBE_FAILED);
    }

    public static function UNSUPPORTED_CODEC(): self
    {
        return new self(self::UNSUPPORTED_CODEC);
    }

    public static function EXCEEDS_DURATION(): self
    {
        return new self(self::EXCEEDS_DURATION);
    }

    public static function EXCEEDS_SIZE(): self
    {
        return new self(self::EXCEEDS_SIZE);
    }

    public static function INVALID_DIMENSIONS(): self
    {
        return new self(self::INVALID_DIMENSIONS);
    }

    public static function TRANSCODE_TIMEOUT(): self
    {
        return new self(self::TRANSCODE_TIMEOUT);
    }

    public static function TRANSCODE_FAILED(): self
    {
        return new self(self::TRANSCODE_FAILED);
    }

    public static function UPLOAD_TO_BUCKET_FAILED(): self
    {
        return new self(self::UPLOAD_TO_BUCKET_FAILED);
    }

    public static function INTERNAL_ERROR(): self
    {
        return new self(self::INTERNAL_ERROR);
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
