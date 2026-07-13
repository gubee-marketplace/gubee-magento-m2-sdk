<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Model\Notification\MissedNotification;
use Gubee\SDK\Resource\AbstractResource;

use function rawurlencode;

class NotificationResource extends AbstractResource
{
    public function missed(string $urlName, $pageable): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->get("/integration/notifications/missed/" . rawurlencode($urlName) . "", $query);

        return $this->hydratePagedResult(
            MissedNotification::class,
            $response,
            [
                'serviceProvider' => $this->getClient()->getServiceProvider(),
            ],
            ['missedNotificationApiDTOList']
        );
    }

    public function markAsRead(string $notificationId): EmptyResult
    {
        $this->delete(
            "/integration/notifications/missed/" . rawurlencode($notificationId) . ""
        );

        return $this->hydrateModel(EmptyResult::class, []);
    }
}
