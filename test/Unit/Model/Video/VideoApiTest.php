<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Video;

use Gubee\SDK\Model\Video\VideoApi;
use PHPUnit\Framework\TestCase;

class VideoApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $video = new VideoApi(
            main: true,
            name: 'name',
            order: 1,
            url: 'https://cdn/x.mp4',
            uuid: 'uuid-1',
            videoId: 'video-1',
            cdnUrl: 'cdn',
            posterUrl: 'poster',
            durationMs: 1000,
            width: 100,
            height: 200,
            sizeBytes: 5000,
            status: 'READY',
            failureReason: 'reason'
        );

        $this->assertTrue($video->getMain());
        $this->assertSame('name', $video->getName());
        $this->assertSame(1, $video->getOrder());
        $this->assertSame('https://cdn/x.mp4', $video->getUrl());
        $this->assertSame('uuid-1', $video->getUuid());
        $this->assertSame('video-1', $video->getVideoId());
        $this->assertSame('cdn', $video->getCdnUrl());
        $this->assertSame('poster', $video->getPosterUrl());
        $this->assertSame(1000, $video->getDurationMs());
        $this->assertSame(100, $video->getWidth());
        $this->assertSame(200, $video->getHeight());
        $this->assertSame(5000, $video->getSizeBytes());
        $this->assertSame('READY', $video->getStatus());
        $this->assertSame('reason', $video->getFailureReason());
    }

    public function testSetters(): void
    {
        $video = new VideoApi(main: false, order: 0, url: 'url');

        $video->setMain(true);
        $video->setName('name-2');
        $video->setOrder(2);
        $video->setUrl('url-2');
        $video->setUuid('uuid-2');
        $video->setVideoId('video-2');
        $video->setCdnUrl('cdn-2');
        $video->setPosterUrl('poster-2');
        $video->setDurationMs(2000);
        $video->setWidth(300);
        $video->setHeight(400);
        $video->setSizeBytes(6000);
        $video->setStatus('FAILED');
        $video->setFailureReason('reason-2');

        $this->assertTrue($video->getMain());
        $this->assertSame('name-2', $video->getName());
        $this->assertSame(2, $video->getOrder());
        $this->assertSame('url-2', $video->getUrl());
        $this->assertSame('uuid-2', $video->getUuid());
        $this->assertSame('video-2', $video->getVideoId());
        $this->assertSame('cdn-2', $video->getCdnUrl());
        $this->assertSame('poster-2', $video->getPosterUrl());
        $this->assertSame(2000, $video->getDurationMs());
        $this->assertSame(300, $video->getWidth());
        $this->assertSame(400, $video->getHeight());
        $this->assertSame(6000, $video->getSizeBytes());
        $this->assertSame('FAILED', $video->getStatus());
        $this->assertSame('reason-2', $video->getFailureReason());
    }

    public function testDefaultsAreNull(): void
    {
        $video = new VideoApi(main: false, order: 0, url: 'url');

        $this->assertNull($video->getName());
        $this->assertNull($video->getUuid());
        $this->assertNull($video->getVideoId());
        $this->assertNull($video->getCdnUrl());
        $this->assertNull($video->getPosterUrl());
        $this->assertNull($video->getDurationMs());
        $this->assertNull($video->getWidth());
        $this->assertNull($video->getHeight());
        $this->assertNull($video->getSizeBytes());
        $this->assertNull($video->getStatus());
        $this->assertNull($video->getFailureReason());
    }
}
