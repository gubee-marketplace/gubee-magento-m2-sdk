<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Model\Video\VideoCommit;
use Gubee\SDK\Model\Video\VideoUploadUrl;
use Gubee\SDK\Resource\VideoResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class VideoResourceContractTest extends ContractTestCase
{
    public function testVideoIntegrationCommit(): void
    {
        $videoId = 'string';

        $payloadData = [
            'videoId'   => 'string',
            'sellerId'  => 'string',
            'ownerType' => 'PRODUCT',
            'ownerId'   => 'string',
        ];
        $payload     = $this->mockPayload(VideoCommit::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new VideoResource($client);
        $this->assertContractCall($client, static function () use ($resource, $videoId, $payload): void {
            $resource->videoIntegrationCommit($videoId, $payload);
        }, false);
    }

    public function testVideoIntegrationUploadUrl(): void
    {
        $payloadData = [
            'sellerId'   => 'string',
            'externalId' => 'string',
            'videoType'  => 'SHORT',
            'ownerType'  => 'PRODUCT',
            'ownerId'    => 'string',
        ];
        $payload     = $this->mockPayload(VideoUploadUrl::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new VideoResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->videoIntegrationUploadUrl($payload);
        }, false);
    }

    public function testVideoIntegrationList(): void
    {
        $status = 'PENDING_UPLOAD';
        $limit  = 50;
        $skip   = 0;

        $client = $this->newContractClient(200);

        $resource = new VideoResource($client);
        $this->assertContractCall($client, static function () use ($resource, $status, $limit, $skip): void {
            $resource->videoIntegrationList($status, $limit, $skip);
        }, false);
    }

    public function testVideoIntegrationStatus(): void
    {
        $videoId = 'string';

        $client = $this->newContractClient(200);

        $resource = new VideoResource($client);
        $this->assertContractCall($client, static function () use ($resource, $videoId): void {
            $resource->videoIntegrationStatus($videoId);
        }, false);
    }

    public function testVideoIntegrationDelete(): void
    {
        $videoId = 'string';

        $client = $this->newContractClient(204);

        $resource = new VideoResource($client);
        $this->assertContractCall($client, static function () use ($resource, $videoId): void {
            $resource->videoIntegrationDelete($videoId);
        }, false);
    }
}
