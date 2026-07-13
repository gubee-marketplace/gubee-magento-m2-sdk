<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Common\StringValue;
use Gubee\SDK\Resource\AbstractResource;

use function rawurlencode;

class ImageResource extends AbstractResource
{
    public function resizeImageBinary(string $sellerId, string $dimensions, string $url, ?string $format = null, ?int $minWidth = null, ?int $maxWidth = null, ?int $minHeight = null, ?int $maxHeight = null): StringValue
    {
        $query = [
            'url'       => $url,
            'format'    => $format,
            'minWidth'  => $minWidth,
            'maxWidth'  => $maxWidth,
            'minHeight' => $minHeight,
            'maxHeight' => $maxHeight,
        ];

        $response = $this->get("/integration/images/resize/url/" . rawurlencode($sellerId) . "/" . rawurlencode($dimensions) . "", $query);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function resizeImageUrl(string $sellerId, string $dimensions, string $url, ?string $format = null, ?int $minWidth = null, ?int $maxWidth = null, ?int $minHeight = null, ?int $maxHeight = null): StringValue
    {
        $query = [
            'url'       => $url,
            'format'    => $format,
            'minWidth'  => $minWidth,
            'maxWidth'  => $maxWidth,
            'minHeight' => $minHeight,
            'maxHeight' => $maxHeight,
        ];

        $response = $this->get("/integration/images/resize/url/" . rawurlencode($sellerId) . "/" . rawurlencode($dimensions) . "/presigned", $query);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }
}
