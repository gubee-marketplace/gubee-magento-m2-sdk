<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\Attribute;
use Gubee\SDK\Resource\AbstractResource;

use function rawurlencode;
use function sizeof;

class AttributeResource extends AbstractResource
{
    public function create(Attribute $attribute): Attribute
    {
        $response = $this->post(
            '/integration/attributes',
            $attribute->jsonSerialize()
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Attribute::class,
                $response
            );
    }

    public function loadByExternalId(string $externalId): Attribute
    {
        $response = $this->get(
            '/integration/attributes/' . rawurlencode($externalId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Attribute::class,
                $response
            );
    }

    public function updateByExternalId(string $externalId, Attribute $attribute): Attribute
    {
        $response = $this->put(
            '/integration/attributes/' . rawurlencode($externalId),
            $attribute->jsonSerialize()
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Attribute::class,
                $response
            );
    }

    /**
     * Bulk create a collection of attributes at once
     *
     * @param array<Attribute> $attributes
     * @return array<Attribute>
     */
    public function bulkCreate(array $attributes): bool
    {
        $response = $this->post(
            '/integration/attributes/bulk',
            $attributes
        );

        foreach ($response as $key => $value) {
            $response[$key] = $this->getClient()->getServiceProvider()
                ->create(
                    Attribute::class,
                    $value
                );
        }

        return sizeof($response) > 0 ? true : false;
    }

    /**
     * Bulk update a collection of attributes at once
     *
     * @param array<Attribute> $attributes
     * @return array<Attribute>
     */
    public function bulkUpdate(array $attributes): bool
    {
        $response = $this->put(
            '/integration/attributes/bulk',
            $attributes
        );

        return sizeof($response) > 0 ? true : false;
    }

    public function loadById(string $id): Attribute
    {
        $response = $this->get(
            '/integration/attributes/byId/' . rawurlencode($id)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Attribute::class,
                $response
            );
    }

    public function loadByName(string $name): Attribute
    {
        $response = $this->get(
            '/integration/attributes/byName/' . rawurlencode($name)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Attribute::class,
                $response
            );
    }

    public function updateByName(string $name, Attribute $attribute): Attribute
    {
        $response = $this->put(
            '/integration/attributes/byName/' . rawurlencode($name),
            $attribute->jsonSerialize()
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Attribute::class,
                $response
            );
    }
}
