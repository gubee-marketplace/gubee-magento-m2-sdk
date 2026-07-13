<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order\Queue;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\StatusEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedError;

use function is_array;
use function is_string;

class RejectedOrderStatus extends AbstractModel
{
    protected StatusEnum $status;

    /** @var array<RejectedError> */

    protected array $errors;

    /**
     * @param array<RejectedError|array<mixed>> $errors
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        StatusEnum|string $status,
        array $errors
    ) {
        if (is_string($status)) {
            $status = StatusEnum::fromValue($status);
        }
        $this->setStatus($status);
        foreach ($errors as $key => $value) {
            if (is_array($value)) {
                $errors[$key] = $serviceProvider->create(
                    RejectedError::class,
                    $value
                );
            }
        }
        $this->setErrors($errors);
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array<RejectedError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array<RejectedError> $errors
     */
    public function setErrors(array $errors): self
    {
        $this->validateArrayElements($errors, RejectedError::class);
        $this->errors = $errors;
        return $this;
    }
}
