<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Sales\Order;

use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Model\Sales\Order\OrderApi;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedOrder;
use Gubee\SDK\Resource\AbstractResource;

use function rawurlencode;

class QueueResource extends AbstractResource
{
    public function listOrdersByStatusQueue(string $status, mixed $pageable): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->get("/integration/orders/queue/" . rawurlencode($status) . "/", $query);

        return $this->hydratePagedResult(
            OrderApi::class,
            $response
        );
    }

    public function listOrdersByStatusQueue_1(string $status, mixed $pageable): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->get("/integration/orders/queue/" . rawurlencode($status) . "", $query);

        return $this->hydratePagedResult(
            OrderApi::class,
            $response
        );
    }

    public function listRejectedQueueOrders(mixed $pageable): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->get("/integration/orders/queue/rejected", $query);

        return $this->hydratePagedResult(
            RejectedOrder::class,
            $response
        );
    }

    public function deleteOrderFromQueue(string $status, string $orderId): EmptyResult
    {
        $this->delete(
            "/integration/orders/queue/" . rawurlencode($status) . "/" . rawurlencode($orderId) . ""
        );

        return $this->hydrateModel(EmptyResult::class, []);
    }
}
