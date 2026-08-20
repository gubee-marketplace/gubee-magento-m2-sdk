<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Video;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Video\FailureReasonEnum;
use Gubee\SDK\Enum\Video\OwnerTypeEnum;
use Gubee\SDK\Enum\Video\StatusEnum;
use Gubee\SDK\Enum\Video\VideoTypeEnum;
use Gubee\SDK\Model\Video\AppliedLimits;
use Gubee\SDK\Model\Video\VideoStatus;
use PHPUnit\Framework\TestCase;

class VideoStatusTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorAndGetters(): void
    {
        $status = new VideoStatus(
            $this->serviceProvider(),
            'video-1',
            'seller-1',
            'READY',
            'SHORT',
            'PRODUCT',
            'owner-1',
            'cdn',
            'poster',
            1000,
            100,
            200,
            5000,
            'PROBE_FAILED',
            'detail',
            ['maxSizeBytes' => 1, 'maxDurationMs' => 2, 'minWidth' => 3, 'minHeight' => 4]
        );

        $this->assertSame('video-1', $status->getVideoId());
        $this->assertSame('seller-1', $status->getSellerId());
        $this->assertEquals(StatusEnum::READY(), $status->getStatus());
        $this->assertEquals(VideoTypeEnum::SHORT(), $status->getVideoType());
        $this->assertEquals(OwnerTypeEnum::PRODUCT(), $status->getOwnerType());
        $this->assertSame('owner-1', $status->getOwnerId());
        $this->assertSame('cdn', $status->getCdnUrl());
        $this->assertSame('poster', $status->getPosterUrl());
        $this->assertSame(1000, $status->getDurationMs());
        $this->assertSame(100, $status->getWidth());
        $this->assertSame(200, $status->getHeight());
        $this->assertSame(5000, $status->getSizeBytes());
        $this->assertEquals(FailureReasonEnum::PROBE_FAILED(), $status->getFailureReason());
        $this->assertSame('detail', $status->getFailureDetail());
        $this->assertInstanceOf(AppliedLimits::class, $status->getLimits());
    }

    public function testPassesThroughAlreadyHydratedLimits(): void
    {
        $limits = new AppliedLimits(1, 2, 3, 4);

        $status = new VideoStatus($this->serviceProvider(), limits: $limits);

        $this->assertSame($limits, $status->getLimits());
    }

    public function testSetters(): void
    {
        $status = new VideoStatus($this->serviceProvider());

        $status->setVideoId('video-2');
        $status->setSellerId('seller-2');
        $status->setStatus(StatusEnum::FAILED());
        $status->setVideoType(VideoTypeEnum::LONG());
        $status->setOwnerType(OwnerTypeEnum::ANNOUNCEMENT());
        $status->setOwnerId('owner-2');
        $status->setCdnUrl('cdn-2');
        $status->setPosterUrl('poster-2');
        $status->setDurationMs(2000);
        $status->setWidth(300);
        $status->setHeight(400);
        $status->setSizeBytes(6000);
        $status->setFailureReason(FailureReasonEnum::EXCEEDS_SIZE());
        $status->setFailureDetail('detail-2');
        $limits = new AppliedLimits();
        $status->setLimits($limits);

        $this->assertSame('video-2', $status->getVideoId());
        $this->assertSame('seller-2', $status->getSellerId());
        $this->assertEquals(StatusEnum::FAILED(), $status->getStatus());
        $this->assertEquals(VideoTypeEnum::LONG(), $status->getVideoType());
        $this->assertEquals(OwnerTypeEnum::ANNOUNCEMENT(), $status->getOwnerType());
        $this->assertSame('owner-2', $status->getOwnerId());
        $this->assertSame('cdn-2', $status->getCdnUrl());
        $this->assertSame('poster-2', $status->getPosterUrl());
        $this->assertSame(2000, $status->getDurationMs());
        $this->assertSame(300, $status->getWidth());
        $this->assertSame(400, $status->getHeight());
        $this->assertSame(6000, $status->getSizeBytes());
        $this->assertEquals(FailureReasonEnum::EXCEEDS_SIZE(), $status->getFailureReason());
        $this->assertSame('detail-2', $status->getFailureDetail());
        $this->assertSame($limits, $status->getLimits());
    }

    public function testDefaultsAreNull(): void
    {
        $status = new VideoStatus($this->serviceProvider());

        $this->assertNull($status->getVideoId());
        $this->assertNull($status->getSellerId());
        $this->assertNull($status->getStatus());
        $this->assertNull($status->getVideoType());
        $this->assertNull($status->getOwnerType());
        $this->assertNull($status->getOwnerId());
        $this->assertNull($status->getCdnUrl());
        $this->assertNull($status->getPosterUrl());
        $this->assertNull($status->getDurationMs());
        $this->assertNull($status->getWidth());
        $this->assertNull($status->getHeight());
        $this->assertNull($status->getSizeBytes());
        $this->assertNull($status->getFailureReason());
        $this->assertNull($status->getFailureDetail());
        $this->assertNull($status->getLimits());
    }
}
