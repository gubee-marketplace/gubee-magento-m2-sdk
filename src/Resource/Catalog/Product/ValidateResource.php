<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product;
use Gubee\SDK\Resource\AbstractResource;

class ValidateResource extends AbstractResource
{
    public function create(Product $product): array
    {
        return $this->post(
            '/integration/validations/product/create',
            $product->jsonSerialize()
        );
    }

    public function update(Product $product): array
    {
        return $this->post(
            '/integration/validations/product/update',
            $product->jsonSerialize()
        );
    }
}
