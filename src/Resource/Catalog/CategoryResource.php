<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog;

use Gubee\SDK\Model\Catalog\Category;
use Gubee\SDK\Resource\AbstractResource;

use function rawurlencode;

class CategoryResource extends AbstractResource
{
    // POST
    // ​/integration​/categories
    // Create category
    public function create(Category $category)
    {
        $response = $this->post(
            '/integration/categories',
            $category->jsonSerialize()
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Category::class,
                $response
            );
    }

    // GET
    // ​/integration​/categories​/{externalId}
    // Get category by externalId
    public function loadByExternalId(string $externalId): Category
    {
        $response = $this->get(
            '/integration/categories/' . rawurlencode($externalId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Category::class,
                $response
            );
    }

    // PUT
    // ​/integration​/categories​/{externalId}
    // Update category
    public function updateByExternalId(string $externalId, Category $category): Category
    {
        $response = $this->put(
            '/integration/categories/' . rawurlencode($externalId),
            $category->jsonSerialize()
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Category::class,
                $response
            );
    }

    // POST
    // ​/integration​/categories​/bulk
    // Create category
    public function bulkCreate(array $categories): bool
    {
        $response = $this->post(
            '/integration/categories/bulk',
            $categories
        );
        return true;
    }

    // PUT
    // ​/integration​/categories​/bulk
    // Update category
    public function bulkUpdate(array $categories): bool
    {
        $response = $this->put(
            '/integration/categories/bulk',
            $categories
        );

        return true;
    }

    // GET
    // ​/integration​/categories​/byId​/{id}
    // Get category by gubee
    public function loadById(string $id): Category
    {
        $response = $this->get(
            '/integration/categories/byId/' . rawurlencode($id)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Category::class,
                $response
            );
    }
}
