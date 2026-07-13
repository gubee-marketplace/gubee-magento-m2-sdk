<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Video;

use Gubee\SDK\Enum\Video\OwnerTypeEnum;
use Gubee\SDK\Enum\Video\StatusEnum;
use Gubee\SDK\Model\Video\VideoCommit;
use PHPUnit\Framework\TestCase;

class VideoCommitTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $commit = new VideoCommit('video-1', 'seller-1', 'PRODUCT', 'owner-1', 'READY');

        $this->assertSame('video-1', $commit->getVideoId());
        $this->assertSame('seller-1', $commit->getSellerId());
        $this->assertEquals(OwnerTypeEnum::PRODUCT(), $commit->getOwnerType());
        $this->assertSame('owner-1', $commit->getOwnerId());
        $this->assertEquals(StatusEnum::READY(), $commit->getStatus());
    }

    public function testSetters(): void
    {
        $commit = new VideoCommit();

        $commit->setVideoId('video-2');
        $commit->setSellerId('seller-2');
        $commit->setOwnerType(OwnerTypeEnum::ANNOUNCEMENT());
        $commit->setOwnerId('owner-2');
        $commit->setStatus(StatusEnum::FAILED());

        $this->assertSame('video-2', $commit->getVideoId());
        $this->assertSame('seller-2', $commit->getSellerId());
        $this->assertEquals(OwnerTypeEnum::ANNOUNCEMENT(), $commit->getOwnerType());
        $this->assertSame('owner-2', $commit->getOwnerId());
        $this->assertEquals(StatusEnum::FAILED(), $commit->getStatus());
    }

    public function testDefaultsAreNull(): void
    {
        $commit = new VideoCommit();

        $this->assertNull($commit->getVideoId());
        $this->assertNull($commit->getSellerId());
        $this->assertNull($commit->getOwnerType());
        $this->assertNull($commit->getOwnerId());
        $this->assertNull($commit->getStatus());
    }
}
