<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Tag;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Tag\TagGroupApi;
use PHPUnit\Framework\TestCase;

class TagGroupApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $date  = new DateTime('2024-01-01T00:00:00+00:00');
        $group = new TagGroupApi(
            'id-1',
            'account-1',
            $date,
            ['order-1', 'order-2'],
            'error',
            'status',
            ['type-1'],
            'pdf-link',
            'zpl-link'
        );

        $this->assertSame('id-1', $group->getId());
        $this->assertSame('account-1', $group->getAccountId());
        $this->assertInstanceOf(DateTimeInterface::class, $group->getCreatedDt());
        $this->assertSame(['order-1', 'order-2'], $group->getOrdersGroup());
        $this->assertSame('error', $group->getErrorMessage());
        $this->assertSame('status', $group->getStatus());
        $this->assertSame(['type-1'], $group->getPackageType());
        $this->assertSame('pdf-link', $group->getPdfLink());
        $this->assertSame('zpl-link', $group->getZplLink());
    }

    public function testAcceptsDateTimeInterfaceDirectly(): void
    {
        $date = new DateTime('2024-01-01');

        $group = new TagGroupApi(null, null, null, []);
        $group->setCreatedDt($date);

        $this->assertSame($date, $group->getCreatedDt());
    }

    public function testConstructorSetsCreatedDateWhenProvided(): void
    {
        $date = new DateTime('2024-01-01');

        $group = new TagGroupApi(null, null, $date, []);

        $this->assertSame($date, $group->getCreatedDt());
    }

    public function testSetters(): void
    {
        $group = new TagGroupApi(null, null, null, []);

        $group->setId('id-2');
        $group->setAccountId('account-2');
        $date = new DateTime('2024-02-01');
        $group->setCreatedDt($date);
        $group->setOrdersGroup(['order-3']);
        $group->setErrorMessage('err');
        $group->setStatus('done');
        $group->setPackageType(['a']);
        $group->setPdfLink('pdf');
        $group->setZplLink('zpl');

        $this->assertSame('id-2', $group->getId());
        $this->assertSame('account-2', $group->getAccountId());
        $this->assertSame($date, $group->getCreatedDt());
        $this->assertSame(['order-3'], $group->getOrdersGroup());
        $this->assertSame('err', $group->getErrorMessage());
        $this->assertSame('done', $group->getStatus());
        $this->assertSame(['a'], $group->getPackageType());
        $this->assertSame('pdf', $group->getPdfLink());
        $this->assertSame('zpl', $group->getZplLink());
    }

    public function testDefaultsAreNull(): void
    {
        $group = new TagGroupApi(null, null, null, []);

        $this->assertNull($group->getId());
        $this->assertNull($group->getAccountId());
        $this->assertNull($group->getCreatedDt());
        $this->assertSame([], $group->getOrdersGroup());
        $this->assertNull($group->getErrorMessage());
        $this->assertNull($group->getStatus());
        $this->assertNull($group->getPackageType());
        $this->assertNull($group->getPdfLink());
        $this->assertNull($group->getZplLink());
    }
}
