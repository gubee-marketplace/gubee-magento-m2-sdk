<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Resource;

use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use function json_encode;

final class TokenResourceTest extends TestCase
{
    public function testRevalidateMapsTokenResponse(): void
    {
        $responseData = [
            'id'        => 'string',
            'login'     => 'string',
            'revoked'   => true,
            'sellerId'  => 'string',
            'token'     => 'string',
            'tokenType' => 'ADMIN',
            'validity'  => '2024-03-12T15:43:38.036',
        ];

        $httpClient = new class (new Response(200, ['Content-Type' => 'application/json'], json_encode($responseData))) implements ClientInterface {
            private ResponseInterface $response;

            public function __construct(ResponseInterface $response)
            {
                $this->response = $response;
            }

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                return $this->response;
            }
        };

        $client = new Client(container(), null, new Builder($httpClient));
        $client->setUrl('https://example.test');

        $result = $client->token()->revalidate('a6as1d61as65d1a65sd165a1s6d51a65sd1a');

        $this->assertEquals($responseData['id'], $result->getId());
        $this->assertEquals($responseData['login'], $result->getLogin());
        $this->assertEquals($responseData['revoked'], $result->getRevoked());
        $this->assertEquals($responseData['sellerId'], $result->getSellerId());
        $this->assertEquals($responseData['token'], $result->getToken());
        $this->assertEquals($responseData['tokenType'], $result->getTokenType());
        $this->assertEquals($responseData['validity'], $result->getValidity()->format('Y-m-d\\TH:i:s.v'));
    }
}
