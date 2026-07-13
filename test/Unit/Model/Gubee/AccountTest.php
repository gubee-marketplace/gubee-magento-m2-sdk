<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Gubee;

use Gubee\SDK\Model\Gubee\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $account = new Account();

        $this->assertInstanceOf(Account::class, $account);
    }
}
