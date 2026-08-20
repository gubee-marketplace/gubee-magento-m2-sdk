<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\NotificationResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class NotificationResourceContractTest extends ContractTestCase
{
    public function testMissed(): void
    {
        $urlName  = 'string';
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(200);

        $resource = new NotificationResource($client);
        $this->assertContractCall($client, static function () use ($resource, $urlName, $pageable): void {
            $resource->missed($urlName, $pageable);
        }, false);
    }

    public function testMarkAsRead(): void
    {
        $notificationId = 'string';

        $client = $this->newContractClient(204);

        $resource = new NotificationResource($client);
        $this->assertContractCall($client, static function () use ($resource, $notificationId): void {
            $resource->markAsRead($notificationId);
        }, false);
    }
}
