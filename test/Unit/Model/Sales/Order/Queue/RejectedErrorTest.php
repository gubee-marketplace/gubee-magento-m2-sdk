<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order\Queue;

use Gubee\SDK\Model\Sales\Order\Queue\RejectedError;
use PHPUnit\Framework\TestCase;

class RejectedErrorTest extends TestCase
{
    public function testConstructAndGetters(): void
    {
        $rejectedError = new RejectedError('Invalid payload', 'VALIDATION');

        $this->assertSame('Invalid payload', $rejectedError->getMessage());
        $this->assertSame('VALIDATION', $rejectedError->getReason());
    }

    public function testSetters(): void
    {
        $rejectedError = new RejectedError('Invalid payload', 'VALIDATION');

        $rejectedError->setMessage('Other message');
        $rejectedError->setReason('OTHER');

        $this->assertSame('Other message', $rejectedError->getMessage());
        $this->assertSame('OTHER', $rejectedError->getReason());
    }
}
