<?php

declare (strict_types = 1);

namespace Gubee\SDK\Resource;

class PlatformResource extends AbstractResource {
    public function createdBlacklist() {
        return $this->get(
            '/integration/platforms/blacklist/created'
        );
    }

    public function configuration() {
        return $this->get(
            '/integration/platforms/configuration'
        );
    }
}
