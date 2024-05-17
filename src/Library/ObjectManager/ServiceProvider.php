<?php

declare(strict_types=1);

namespace Gubee\SDK\Library\ObjectManager;

use DI\Container;
use Gubee\SDK\Api\ServiceProviderInterface;

class ServiceProvider extends Container implements ServiceProviderInterface
{
    /**
     * Instantiate a new service of the given type.
     *
     * @param array<mixed, mixed> $arguments
     * @return mixed
     */
    public function create(string $type, array $arguments = [])
    {
        return $this->make($type, $arguments);
    }
}
