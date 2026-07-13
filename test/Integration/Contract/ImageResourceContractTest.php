<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\ImageResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class ImageResourceContractTest extends ContractTestCase
{
    public function testResizeImageBinary(): void
    {
        $sellerId   = 'string';
        $dimensions = 'string';
        $url        = 'string';
        $format     = 'png';
        $minWidth   = 0;
        $maxWidth   = 0;
        $minHeight  = 0;
        $maxHeight  = 0;

        $client = $this->newContractClient(200);

        $resource = new ImageResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sellerId, $dimensions, $url, $format, $minWidth, $maxWidth, $minHeight, $maxHeight): void {
            $resource->resizeImageBinary($sellerId, $dimensions, $url, $format, $minWidth, $maxWidth, $minHeight, $maxHeight);
        }, false);
    }

    public function testResizeImageUrl(): void
    {
        $sellerId   = 'string';
        $dimensions = 'string';
        $url        = 'string';
        $format     = 'JPEG';
        $minWidth   = 0;
        $maxWidth   = 0;
        $minHeight  = 0;
        $maxHeight  = 0;

        $client = $this->newContractClient(200);

        $resource = new ImageResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sellerId, $dimensions, $url, $format, $minWidth, $maxWidth, $minHeight, $maxHeight): void {
            $resource->resizeImageUrl($sellerId, $dimensions, $url, $format, $minWidth, $maxWidth, $minHeight, $maxHeight);
        }, false);
    }
}
