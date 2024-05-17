<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog\Product\Attribute;

use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Resource\AbstractResource;
use InvalidArgumentException;

use function array_merge;
use function rawurlencode;
use function sprintf;

class BrandResource extends AbstractResource
{
    public function create(Brand $brand): Brand
    {
        $response = $this->post(
            '/integration/brands',
            $brand->jsonSerialize()
        );
        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function loadByExternalId(string $externalId): Brand
    {
        $response = $this->get(
            '/integration/brands/' . rawurlencode($externalId)
        );
        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function updateByExternalId(Brand $brand, ?string $externalId = null): Brand
    {
        if ($externalId === null) {
            $externalId = $brand->getId();
        }

        if (! $externalId) {
            throw new InvalidArgumentException(
                sprintf(
                    "External id is required to update brand"
                )
            );
        }

        $response = $this->put(
            '/integration/brands/byExternalId/' . rawurlencode($externalId),
            $brand->jsonSerialize()
        );

        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function loadById(string $id): Brand
    {
        $response = $this->get(
            '/integration/brands/byId/' . rawurlencode($id)
        );
        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function loadByName(string $name): Brand
    {
        $response = $this->get(
            '/integration/brands/byName',
            ['name' => $name]
        );
        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function loadByNameForm(string $name)
    {
        $response = $this->postForm(
            '/integration/brands/byName',
            $name
        );
        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function updateByName(Brand $brand, ?string $name = null): Brand
    {
        if ($name === null) {
            $name = $brand->getName();
        }

        if (! $name) {
            throw new InvalidArgumentException(
                sprintf(
                    "Name is required to update brand"
                )
            );
        }

        $response = $this->put(
            '/integration/brands/byName/' . rawurlencode($name),
            $brand->jsonSerialize()
        );

        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }

    public function updateByNameV2(Brand $brand, ?string $name = null): Brand
    {
        if ($name === null) {
            $name = $brand->getName();
        }

        if (! $name) {
            throw new InvalidArgumentException(
                sprintf(
                    "Name is required to update brand"
                )
            );
        }

        $response = $this->put(
            '/integration/brands/v2/byName/' . rawurlencode($name),
            $brand->jsonSerialize()
        );

        return $this->client->getServiceProvider()
            ->create(
                Brand::class,
                array_merge(
                    $response,
                    [
                        'brandResource' => $this,
                    ]
                )
            );
    }
}
