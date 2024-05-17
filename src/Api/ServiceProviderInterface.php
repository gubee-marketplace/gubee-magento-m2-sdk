<?php

declare(strict_types=1);

namespace Gubee\SDK\Api;

use Psr\Container\ContainerInterface;

interface ServiceProviderInterface extends ContainerInterface
{
    /**
     * Instantiate a new service of the given type.
     *
     * @param array<mixed, mixed> $arguments
     * @return mixed
     */
    public function create(string $type, array $arguments = []);
}
