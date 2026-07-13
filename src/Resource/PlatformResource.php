<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Platform\BlacklistPlatformApi;
use Gubee\SDK\Model\Platform\PlatformConfigurationApi;

class PlatformResource extends AbstractResource
{
    public function createdBlacklist(): array
    {
        return $this->hydrateCollection(
            BlacklistPlatformApi::class,
            $this->get(
                '/integration/platforms/blacklist/created'
            )
        );
    }

    public function configuration(): array
    {
        return $this->hydrateCollection(
            PlatformConfigurationApi::class,
            $this->get(
                '/integration/platforms/configuration'
            )
        );
    }
}
