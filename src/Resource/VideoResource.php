<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Video\VideoCommit;
use Gubee\SDK\Model\Video\VideoStatus;
use Gubee\SDK\Model\Video\VideoUploadUrl;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class VideoResource extends AbstractResource
{
    public function videoIntegrationCommit(string $videoId, VideoCommit|array $payload): VideoCommit
    {
        $response = $this->post("/integration/videos/" . rawurlencode($videoId) . "/commit", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            VideoCommit::class,
            $response
        );
    }

    public function videoIntegrationUploadUrl(VideoUploadUrl|array $payload): VideoUploadUrl
    {
        $response = $this->post("/integration/videos/upload-url", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            VideoUploadUrl::class,
            $response
        );
    }

    public function videoIntegrationList(?string $status = null, ?int $limit = null, ?int $skip = null): array
    {
        $query = [
            'status' => $status,
            'limit'  => $limit,
            'skip'   => $skip,
        ];

        $response = $this->get("/integration/videos", $query);

        return $this->hydrateCollection(
            VideoStatus::class,
            $response
        );
    }

    public function videoIntegrationStatus(string $videoId): VideoStatus
    {
        $response = $this->get(
            "/integration/videos/" . rawurlencode($videoId) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            VideoStatus::class,
            $response
        );
    }

    public function videoIntegrationDelete(string $videoId): EmptyResult
    {
        $this->delete(
            "/integration/videos/" . rawurlencode($videoId) . ""
        );

        return $this->hydrateModel(EmptyResult::class, []);
    }
}
