<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\AttributeGroup\AttributeGroupApi;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class AttributeGroupResource extends AbstractResource
{
    public function getAttributeGroup(string $name): AttributeGroupApi
    {
        $response = $this->get(
            "/integration/attributeGroups/" . rawurlencode($name) . ""
        );

        return $this->hydrateModel(
            AttributeGroupApi::class,
            $response
        );
    }

    public function updateAttributeGroup(string $name, AttributeGroupApi|array $payload): AttributeGroupApi
    {
        $response = $this->put("/integration/attributeGroups/" . rawurlencode($name) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            AttributeGroupApi::class,
            $response
        );
    }

    public function createAttributeGroup(AttributeGroupApi|array $payload): AttributeGroupApi
    {
        $response = $this->post("/integration/attributeGroups", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            AttributeGroupApi::class,
            $response
        );
    }

    public function listAllAttributeGroups($pageable): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->get("/integration/attributeGroups/list/all", $query);

        return $this->hydratePagedResult(
            AttributeGroupApi::class,
            $response,
            [],
            ['attributeGroupApiDTOList']
        );
    }
}
