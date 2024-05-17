<?php

declare (strict_types = 1);

namespace Gubee\SDK\Resource\Sales\Order\Queue;

use Gubee\SDK\Enum\Resource\SortEnum;
use Gubee\SDK\Resource\AbstractResource;

class NotificationResource extends AbstractResource {
    /**
     * Get the canceled orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The canceled orders.
     */
    public function getCanceledOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/canceled',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a canceled order from the queue.
     *
     * @param string $orderId The ID of the canceled order.
     */
    public function removeCanceledOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/canceled/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the created orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The created orders.
     */
    public function getCreatedOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/created',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a created order from the queue.
     *
     * @param string $orderId The ID of the created order.
     */
    public function removeCreatedOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/created/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the delivered orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The delivered orders.
     */
    public function getDeliveredOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/delivered',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a delivered order from the queue.
     *
     * @param string $orderId The ID of the delivered order.
     */
    public function removeDeliveredOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/delivered/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the invoiced orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The invoiced orders.
     */
    public function getInvoicedOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/invoiced',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove an invoiced order from the queue.
     *
     * @param string $orderId The ID of the invoiced order.
     */
    public function removeInvoicedOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/invoiced/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the paid orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The paid orders.
     */
    public function getPaidOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/paid',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a paid order from the queue.
     *
     * @param string $orderId The ID of the paid order.
     */
    public function removePaidOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/paid/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the payed orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The payed orders.
     */
    public function getPayedOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/payed',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a payed order from the queue.
     *
     * @param string $orderId The ID of the payed order.
     */
    public function removePayedOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/payed/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the rejected orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The rejected orders.
     */
    public function getRejectedOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/rejected',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a rejected order from the queue.
     *
     * @param string $orderId The ID of the rejected order.
     */
    public function removeRejectedOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/rejected/" . rawurlencode($orderId)
        );
    }

    /**
     * Get the shipped orders from the queue.
     *
     * @param int $page The page number.
     * @param int $size The number of orders per page.
     * @return array The shipped orders.
     */
    public function getShippedOrders(int $page = 0, int $size = 10, ?SortEnum $sort = null): array {
        return $this->get(
            '/integration/orders/queue/shipped',
            [
                'page' => $page,
                'size' => $size,
                'sort' => $sort != null
                ? $sort->__toString()
                : SortEnum::ASC()->__toString(),
            ]
        );
    }

    /**
     * Remove a shipped order from the queue.
     *
     * @param string $orderId The ID of the shipped order.
     */
    public function removeShippedOrder(string $orderId) {
        return $this->delete(
            "/integration/orders/queue/shipped/" . rawurlencode($orderId)
        );
    }
}
