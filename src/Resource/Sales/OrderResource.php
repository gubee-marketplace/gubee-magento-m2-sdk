<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Sales;

use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Gubee\SDK\Model\Sales\Order\CreateOrderNote;
use Gubee\SDK\Model\Sales\Order\OrderApi;
use Gubee\SDK\Model\Sales\Order\OrderNote;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class OrderResource extends AbstractResource
{
    // GET
    // /integration/orders/{orderId}
    // Get order by orderId
    public function loadByOrderId(string $orderId): OrderApi
    {
        return $this->hydrateModel(
            OrderApi::class,
            $this->get(
                "/integration/orders/" . rawurlencode($orderId)
            )
        );
    }

    // PUT
    // /integration/orders/cancel/{orderId}
    // Update order to cancel
    public function cancelOrder(string $orderId, ?DateTimeInterface $cancelDt = null): OrderApi
    {
        if ($cancelDt === null) {
            $cancelDt = new DateTime(
                'now',
                new DateTimeZone('UTC')
            );
        }

        return $this->hydrateModel(
            OrderApi::class,
            $this->put(
                "/integration/orders/cancel/" . rawurlencode($orderId),
                [
                    'cancelDt' => $cancelDt->format('Y-m-d\TH:i:s\Z'),
                ]
            )
        );
    }

    // POST
    // /integration/orders/create
    // Create order
    public function createOrder(array $order): OrderApi
    {
        return $this->hydrateModel(
            OrderApi::class,
            $this->post(
                "/integration/orders/create",
                $order
            )
        );
    }

    // PUT
    // /integration/orders/delivered/{orderId}/{shipmentCode}
    // Update order to delivered
    public function updateDelivered(string $orderId, string $shipmentCode, DateTimeInterface $deliveredDt): OrderApi
    {
        return $this->hydrateModel(
            OrderApi::class,
            $this->put(
                "/integration/orders/delivered/" . rawurlencode($orderId) . "/" . rawurlencode($shipmentCode),
                [
                    'deliveredDt' => $deliveredDt->format('Y-m-d\TH:i:s\Z'),
                ]
            )
        );
    }

    // PUT
    // /integration/orders/invoiced/{orderId}
    // Update order to invoiced
    public function updateInvoiced(
        string $orderId,
        array $invoice
    ): OrderApi {
        return $this->hydrateModel(
            OrderApi::class,
            $this->put(
                "/integration/orders/invoiced/" . rawurlencode($orderId),
                $invoice,
                [
                    'Content-Type' => 'application/hal+json',
                    'Accept'       => 'application/hal+json',
                ]
            )
        );
    }

    // PUT
    // /integration/orders/paid/{orderId}
    // Update order to paid
    public function updatePaid(string $orderId): OrderApi
    {
        return $this->hydrateModel(
            OrderApi::class,
            $this->put(
                "/integration/orders/paid/" . rawurlencode($orderId)
            )
        );
    }

    // PUT
    // /integration/orders/returned/{orderId}
    // Update order to returned
    public function updateReturned(string $orderId, string $marketplaceStatus): OrderApi
    {
        return $this->returnedOrder($orderId, $marketplaceStatus);
    }

    // PUT
    // /integration/orders/shipped/{orderId}
    // Update order to shipped
    public function updateShipped(string $orderId, array $shipment): OrderApi
    {
        return $this->hydrateModel(
            OrderApi::class,
            $this->put(
                "/integration/orders/shipped/" . rawurlencode($orderId),
                $shipment
            )
        );
    }

    public function returnedOrder(string $orderId, string $marketplaceStatus): OrderApi
    {
        $query = [
            'marketplaceStatus' => $marketplaceStatus,
        ];

        $response = $this->put(
            $query === [] ? "/integration/orders/returned/" . rawurlencode($orderId) . "" : "/integration/orders/returned/" . rawurlencode($orderId) . "" . self::build($query),
            []
        );

        return $this->hydrateModel(
            OrderApi::class,
            $response
        );
    }

    public function createOrderNote(string $accountId, string $orderId, CreateOrderNote|array $payload): OrderNote
    {
        $response = $this->post("/integration/orders/" . rawurlencode($accountId) . "/" . rawurlencode($orderId) . "/notes", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            OrderNote::class,
            $response
        );
    }
}
