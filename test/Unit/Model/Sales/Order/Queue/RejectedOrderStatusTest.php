<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order\Queue;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\StatusEnum;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedError;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedOrderStatus;
use PHPUnit\Framework\TestCase;

class RejectedOrderStatusTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesErrorsFromRawArrays(): void
    {
        $rejectedOrderStatus = $this->serviceProvider()->create(
            RejectedOrderStatus::class,
            [
                'status' => 'CREATED',
                'errors' => [['message' => 'Invalid payload', 'reason' => 'VALIDATION']],
            ]
        );

        $this->assertInstanceOf(StatusEnum::class, $rejectedOrderStatus->getStatus());
        $this->assertContainsOnlyInstancesOf(RejectedError::class, $rejectedOrderStatus->getErrors());
        $this->assertSame('Invalid payload', $rejectedOrderStatus->getErrors()[0]->getMessage());
    }

    public function testPassesThroughAlreadyHydratedErrors(): void
    {
        $error = new RejectedError('Invalid payload', 'VALIDATION');

        $rejectedOrderStatus = $this->serviceProvider()->create(
            RejectedOrderStatus::class,
            ['status' => 'CREATED', 'errors' => [$error]]
        );

        $this->assertSame($error, $rejectedOrderStatus->getErrors()[0]);
    }

    public function testAcceptsStatusEnumInstance(): void
    {
        $status              = StatusEnum::CANCELED();
        $rejectedOrderStatus = $this->serviceProvider()->create(
            RejectedOrderStatus::class,
            ['status' => $status, 'errors' => []]
        );

        $this->assertSame($status, $rejectedOrderStatus->getStatus());
    }

    public function testSetters(): void
    {
        $error = new RejectedError('Invalid payload', 'VALIDATION');

        $rejectedOrderStatus = $this->serviceProvider()->create(
            RejectedOrderStatus::class,
            ['status' => 'CREATED', 'errors' => []]
        );

        $status = StatusEnum::CANCELED();
        $rejectedOrderStatus->setStatus($status);
        $rejectedOrderStatus->setErrors([$error]);

        $this->assertSame($status, $rejectedOrderStatus->getStatus());
        $this->assertSame([$error], $rejectedOrderStatus->getErrors());
    }
}
