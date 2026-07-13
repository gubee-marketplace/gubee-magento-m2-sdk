<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Token;

class TokenResource extends AbstractResource
{
    public function revalidate(string $token): Token
    {
        $response = $this->post(
            '/integration/tokens/revalidate/apitoken',
            $token,
            [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/hal+json',
            ]
        );

        return $this->hydrateModel(
            Token::class,
            $response
        );
    }
}
