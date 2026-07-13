<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Video;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Video\StatusEnum;
use Gubee\SDK\Model\Video\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $video = new Video(
            id: 'id-1',
            videoId: 'video-1',
            sellerId: 'seller-1',
            status: 'READY',
            failureReason: 'failure',
            cdnUrl: 'https://cdn/x.mp4',
            posterUrl: 'https://cdn/x.png',
            durationMs: 1000,
            width: 100,
            height: 200,
            sizeBytes: 5000,
            main: true,
            name: 'video',
            order: 1,
            ownerType: 'PRODUCT',
            ownerId: 'owner-1',
            processedAt: new DateTime('2024-01-01'),
            url: 'https://cdn/x.mp4'
        );

        $this->assertSame('id-1', $video->getId());
        $this->assertSame('video-1', $video->getVideoId());
        $this->assertSame('seller-1', $video->getSellerId());
        $this->assertEquals(StatusEnum::READY(), $video->getStatus());
        $this->assertSame('failure', $video->getFailureReason());
        $this->assertSame('https://cdn/x.mp4', $video->getCdnUrl());
        $this->assertSame('https://cdn/x.png', $video->getPosterUrl());
        $this->assertSame(1000, $video->getDurationMs());
        $this->assertSame(100, $video->getWidth());
        $this->assertSame(200, $video->getHeight());
        $this->assertSame(5000, $video->getSizeBytes());
        $this->assertTrue($video->getMain());
        $this->assertSame('video', $video->getName());
        $this->assertSame(1, $video->getOrder());
        $this->assertSame('PRODUCT', $video->getOwnerType());
        $this->assertSame('owner-1', $video->getOwnerId());
        $this->assertInstanceOf(DateTimeInterface::class, $video->getProcessedAt());
        $this->assertSame('https://cdn/x.mp4', $video->getUrl());
    }

    public function testSetters(): void
    {
        $video = new Video(status: StatusEnum::PENDING_UPLOAD(), main: false, order: 0);

        $video->setId('id-2');
        $video->setVideoId('video-2');
        $video->setSellerId('seller-2');
        $video->setStatus(StatusEnum::FAILED());
        $video->setFailureReason('reason');
        $video->setCdnUrl('cdn');
        $video->setPosterUrl('poster');
        $video->setDurationMs(2000);
        $video->setWidth(300);
        $video->setHeight(400);
        $video->setSizeBytes(6000);
        $video->setMain(true);
        $video->setName('new-name');
        $video->setOrder(2);
        $video->setOwnerType('ANNOUNCEMENT');
        $video->setOwnerId('owner-2');
        $date = new DateTime('2024-02-01');
        $video->setProcessedAt($date);
        $video->setUrl('url');

        $this->assertSame('id-2', $video->getId());
        $this->assertSame('video-2', $video->getVideoId());
        $this->assertSame('seller-2', $video->getSellerId());
        $this->assertEquals(StatusEnum::FAILED(), $video->getStatus());
        $this->assertSame('reason', $video->getFailureReason());
        $this->assertSame('cdn', $video->getCdnUrl());
        $this->assertSame('poster', $video->getPosterUrl());
        $this->assertSame(2000, $video->getDurationMs());
        $this->assertSame(300, $video->getWidth());
        $this->assertSame(400, $video->getHeight());
        $this->assertSame(6000, $video->getSizeBytes());
        $this->assertTrue($video->getMain());
        $this->assertSame('new-name', $video->getName());
        $this->assertSame(2, $video->getOrder());
        $this->assertSame('ANNOUNCEMENT', $video->getOwnerType());
        $this->assertSame('owner-2', $video->getOwnerId());
        $this->assertSame($date, $video->getProcessedAt());
        $this->assertSame('url', $video->getUrl());
    }

    public function testDefaultsAreNull(): void
    {
        $video = new Video(status: StatusEnum::PENDING_UPLOAD(), main: false, order: 0);

        $this->assertNull($video->getId());
        $this->assertNull($video->getVideoId());
        $this->assertNull($video->getSellerId());
        $this->assertNull($video->getFailureReason());
        $this->assertNull($video->getCdnUrl());
        $this->assertNull($video->getPosterUrl());
        $this->assertNull($video->getDurationMs());
        $this->assertNull($video->getWidth());
        $this->assertNull($video->getHeight());
        $this->assertNull($video->getSizeBytes());
        $this->assertNull($video->getName());
        $this->assertNull($video->getOwnerType());
        $this->assertNull($video->getOwnerId());
        $this->assertNull($video->getProcessedAt());
        $this->assertNull($video->getUrl());
    }
}
