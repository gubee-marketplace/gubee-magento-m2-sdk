<?php

declare (strict_types = 1);

namespace Gubee\SDK\Resource\Sales;

use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Gubee\SDK\Resource\AbstractResource;

class OrderResource extends AbstractResource
{
    // GET
    // /integration/orders/{orderId}
    // Get order by orderId
    public function loadByOrderId(string $orderId)
    {
        return $this->get(
            "/integration/orders/" . rawurlencode($orderId)
        );
    }

    // PUT
    // /integration/orders/cancel/{orderId}
    // Update order to cancel
    public function cancelOrder(string $orderId, ?DateTimeInterface $cancelDt = null)
    {
        if ($cancelDt == null) {
            $cancelDt = new DateTime(
                'now',
                new DateTimeZone('UTC')
            );
        }

        return $this->put(
            "/integration/orders/cancel/" . rawurlencode($orderId),
            [
                'cancelDt' => $cancelDt->format('Y-m-d\TH:i:s\Z'),
            ]
        );
    }

    // POST
    // /integration/orders/create
    // Create order
    public function createOrder(array $order)
    {
        return $this->post(
            "/integration/orders/create",
            $order
        );
    }

    // PUT
    // /integration/orders/delivered/{orderId}/{shipmentCode}
    // Update order to delivered
    public function updateDelivered(string $orderId, string $shipmentCode, DateTimeInterface $deliveredDt)
    {
        if ($deliveredDt == null) {
            $deliveredDt = new DateTime(
                'now',
                new DateTimeZone('UTC')
            );
        }

        return $this->put(
            "/integration/orders/delivered/" . rawurlencode($orderId) . "/" . rawurlencode($shipmentCode),
            [
                'deliveredDt' => $deliveredDt->format('Y-m-d\TH:i:s\Z'),
            ]
        );
    }

    // PUT
    // /integration/orders/invoiced/{orderId}
    // Update order to invoiced
    public function updateInvoiced(
        string $orderId,
        array $invoice
    ) {
        return $this->put(
            "/integration/orders/invoiced/" . rawurlencode($orderId),
            $invoice,
            [
                'Content-Type' => 'application/hal+json',
                'Accept' => 'application/hal+json',
            ]
        );
    }

    // PUT
    // /integration/orders/paid/{orderId}
    // Update order to paid
    public function updatePaid(string $orderId)
    {
        return $this->put(
            "/integration/orders/paid/" . rawurlencode($orderId)
        );
    }

    // PUT
    // /integration/orders/returned/{orderId}
    // Update order to returned
    public function updateReturned(string $orderId)
    {
        // todo
    }

    // PUT
    // /integration/orders/shipped/{orderId}
    // Update order to shipped
    public function updateShipped(string $orderId, array $shipment)
    {
        return $this->put(
            "/integration/orders/shipped/" . rawurlencode($orderId),
            $shipment
        );
    }
}
