<?php

declare (strict_types = 1);

namespace Gubee\SDK\Resource\Catalog;

use Gubee\SDK\Model\Catalog\Product;
use Gubee\SDK\Resource\AbstractResource;

class ProductResource extends AbstractResource {
    // POST
    // /integration/products
    // Create product
    public function create(Product $product) {
        $response = $this->post(
            '/integration/products',
            $product->jsonSerialize()
        );
    }

    // GET
    // /integration/products/{productId}
    // Get product by productId
    public function loadById(string $id): Product {
        $response = $this->get(
            '/integration/products/' . rawurlencode($id)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Product::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // PUT
    // /integration/products/{productId}
    // Update product
    public function update(string $id, Product $product): void {
        $this->put(
            '/integration/products/' . rawurlencode($id),
            $product->jsonSerialize()
        );
    }

    // DELETE
    // /integration/products/{productId}
    // Delete product
    public function deleteById(string $id): void {
        $this->delete(
            '/integration/products/' . rawurlencode($id)
        );
    }

    // GET
    // /integration/products/bySku/{sku}
    // Get product by variations.sku

    public function getBySku(string $sku): Product {
        $response = $this->get(
            '/integration/products/bySku/' . rawurlencode($sku)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Product::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // GET
    // /integration/products/bySkuId/{skuId}
    // Get product by variations.skuId
    public function getBySkuId(string $skuId): Product {
        $response = $this->get(
            '/integration/products/bySkuId/' . rawurlencode($skuId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Product::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // PUT
    // /integration/products/image/{productId}/{skuId}
    // Update the list of image of skuId
    public function updateImage(string $productId, string $skuId, array $images): Product {
        $response = $this->put(
            '/integration/products/image/' . rawurlencode($productId) . '/' . rawurlencode($skuId),
            $images
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Product::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // POST
    // /integration/products/list/search
    // search products
    public function search(array $filters): array {
        $response = $this->post(
            '/integration/products/list/search',
            $filters
        );

        $products = [];
        foreach ($response as $productData) {
            $products[] = $this->getClient()->getServiceProvider()
                ->create(
                    Product::class,
                    array_merge(
                        [$this],
                        $productData
                    )
                );
        }

        return $products;
    }

    // GET
    // /integration/products/listAll
    // list products
    public function listAll(): array {
        $response = $this->get(
            '/integration/products/listAll'
        );

        $products = [];
        foreach ($response as $productData) {
            $products[] = $this->getClient()->getServiceProvider()
                ->create(
                    Product::class,
                    array_merge(
                        [$this],
                        $productData
                    )
                );
        }

        return $products;
    }

    // GET
    // /integration/products/v2/byProductId/{productId}
    // Get api product by productId
    public function getApiProductByProductId(string $productId): Product {
        $response = $this->get(
            '/integration/products/v2/byProductId/' . rawurlencode($productId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Product::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }
}
