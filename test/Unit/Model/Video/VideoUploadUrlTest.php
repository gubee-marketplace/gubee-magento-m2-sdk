<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Video;

use Gubee\SDK\Enum\Video\OwnerTypeEnum;
use Gubee\SDK\Enum\Video\VideoTypeEnum;
use Gubee\SDK\Model\Video\VideoUploadUrl;
use PHPUnit\Framework\TestCase;

class VideoUploadUrlTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $upload = new VideoUploadUrl(
            'seller-1',
            'external-1',
            'SHORT',
            'PRODUCT',
            'owner-1',
            1000,
            'video-1',
            'https://upload',
            123456
        );

        $this->assertSame('seller-1', $upload->getSellerId());
        $this->assertSame('external-1', $upload->getExternalId());
        $this->assertEquals(VideoTypeEnum::SHORT(), $upload->getVideoType());
        $this->assertEquals(OwnerTypeEnum::PRODUCT(), $upload->getOwnerType());
        $this->assertSame('owner-1', $upload->getOwnerId());
        $this->assertSame(1000, $upload->getExpectedSizeBytes());
        $this->assertSame('video-1', $upload->getVideoId());
        $this->assertSame('https://upload', $upload->getUploadUrl());
        $this->assertSame(123456, $upload->getExpiresAt());
    }

    public function testSetters(): void
    {
        $upload = new VideoUploadUrl();

        $upload->setSellerId('seller-2');
        $upload->setExternalId('external-2');
        $upload->setVideoType(VideoTypeEnum::LONG());
        $upload->setOwnerType(OwnerTypeEnum::ANNOUNCEMENT());
        $upload->setOwnerId('owner-2');
        $upload->setExpectedSizeBytes(2000);
        $upload->setVideoId('video-2');
        $upload->setUploadUrl('upload-2');
        $upload->setExpiresAt(654321);

        $this->assertSame('seller-2', $upload->getSellerId());
        $this->assertSame('external-2', $upload->getExternalId());
        $this->assertEquals(VideoTypeEnum::LONG(), $upload->getVideoType());
        $this->assertEquals(OwnerTypeEnum::ANNOUNCEMENT(), $upload->getOwnerType());
        $this->assertSame('owner-2', $upload->getOwnerId());
        $this->assertSame(2000, $upload->getExpectedSizeBytes());
        $this->assertSame('video-2', $upload->getVideoId());
        $this->assertSame('upload-2', $upload->getUploadUrl());
        $this->assertSame(654321, $upload->getExpiresAt());
    }

    public function testDefaultsAreNull(): void
    {
        $upload = new VideoUploadUrl();

        $this->assertNull($upload->getSellerId());
        $this->assertNull($upload->getExternalId());
        $this->assertNull($upload->getVideoType());
        $this->assertNull($upload->getOwnerType());
        $this->assertNull($upload->getOwnerId());
        $this->assertNull($upload->getExpectedSizeBytes());
        $this->assertNull($upload->getVideoId());
        $this->assertNull($upload->getUploadUrl());
        $this->assertNull($upload->getExpiresAt());
    }
}
