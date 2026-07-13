<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Resource;

use DateTimeImmutable;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Model\Ad\Ad;
use Gubee\SDK\Model\Catalog\Category;
use Gubee\SDK\Model\Catalog\Product;
use Gubee\SDK\Model\Catalog\Product\Attribute;
use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Model\Catalog\Product\AttributeGroup\AttributeGroupApi;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\SkuPrice;
use Gubee\SDK\Model\Catalog\Product\Variation\Stock;
use Gubee\SDK\Model\Catalog\Product\Variation\StockQuery;
use Gubee\SDK\Model\Catalog\Product\VariationSkuApiMap;
use Gubee\SDK\Model\Catalog\ProductV2;
use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Model\Common\ScrollResult;
use Gubee\SDK\Model\Common\StringList;
use Gubee\SDK\Model\Common\StringMap;
use Gubee\SDK\Model\Common\StringValue;
use Gubee\SDK\Model\Invoice\InvoiceApiModel;
use Gubee\SDK\Model\Notification\MissedNotification;
use Gubee\SDK\Model\Platform\BlacklistPlatformApi;
use Gubee\SDK\Model\Platform\PlatformConfigurationApi;
use Gubee\SDK\Model\Promotion\Promotion;
use Gubee\SDK\Model\Sales\Order\Invoice;
use Gubee\SDK\Model\Sales\Order\LogisticTypeMappingApi;
use Gubee\SDK\Model\Sales\Order\OrderApi;
use Gubee\SDK\Model\Sales\Order\OrderTagApi;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedOrder;
use Gubee\SDK\Model\Shipping\ShippingQuotesApi;
use Gubee\SDK\Model\Tag\TagGroupApi;
use Gubee\SDK\Model\Tag\TagPackageApi;
use Gubee\SDK\Model\Token;
use Gubee\SDK\Model\Video\VideoStatus;
use Gubee\SDK\Resource\AdResource;
use Gubee\SDK\Resource\Catalog\CategoryResource;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use Gubee\SDK\Resource\Catalog\Product\AttributeGroupResource;
use Gubee\SDK\Resource\Catalog\Product\AttributeResource;
use Gubee\SDK\Resource\Catalog\Product\Variation\PriceResource;
use Gubee\SDK\Resource\Catalog\Product\Variation\StockResource;
use Gubee\SDK\Resource\Catalog\ProductResource;
use Gubee\SDK\Resource\Catalog\ProductV2Resource;
use Gubee\SDK\Resource\ImageResource;
use Gubee\SDK\Resource\Invoicer\InvoiceResource;
use Gubee\SDK\Resource\LogisticTypeMappingResource;
use Gubee\SDK\Resource\NotificationResource;
use Gubee\SDK\Resource\PlatformResource;
use Gubee\SDK\Resource\PromotionResource;
use Gubee\SDK\Resource\Sales\Order\QueueResource;
use Gubee\SDK\Resource\Sales\OrderResource;
use Gubee\SDK\Resource\Shipping\FreightQuoteResource;
use Gubee\SDK\Resource\SkuResolveResource;
use Gubee\SDK\Resource\TagResource;
use Gubee\SDK\Resource\TokenResource;
use Gubee\SDK\Resource\VideoResource;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

use function array_map;
use function array_shift;
use function count;
use function is_array;
use function json_encode;

final class ResourceHydrationTest extends TestCase
{
    /**
     * @dataProvider directModelProvider
     * @param class-string $resourceClass
     * @param list<mixed> $arguments
     * @param class-string $expectedModelClass
     */
    public function testDirectModelResponsesAreHydrated(
        string $resourceClass,
        string $method,
        array $arguments,
        string $expectedModelClass,
        $responseBody,
        ?array $expectedArguments = null
    ): void {
        $serviceProvider = new RecordingServiceProvider(
            [
                $expectedModelClass => [$this->modelDouble($expectedModelClass)],
            ]
        );
        $resource        = new $resourceClass($this->newClient($serviceProvider, $responseBody));
        $arguments       = array_map([$this, 'resolveArgument'], $arguments);

        $result = $resource->{$method}(...$arguments);

        self::assertInstanceOf($expectedModelClass, $result);
        self::assertCount(1, $serviceProvider->calls);
        self::assertSame($expectedModelClass, $serviceProvider->calls[0]['type']);

        if ($expectedArguments === null) {
            self::assertSame($responseBody, $serviceProvider->calls[0]['arguments']);
            return;
        }

        foreach ($expectedArguments as $key => $value) {
            self::assertArrayHasKey($key, $serviceProvider->calls[0]['arguments']);
            self::assertSame(
                $this->resolveExpectedArgument($value, $serviceProvider, $resource),
                $serviceProvider->calls[0]['arguments'][$key]
            );
        }
    }

    /**
     * @dataProvider collectionProvider
     * @param class-string $resourceClass
     * @param list<mixed> $arguments
     * @param class-string $expectedModelClass
     * @param list<array<string, mixed>> $responseBody
     */
    public function testCollectionResponsesAreHydrated(
        string $resourceClass,
        string $method,
        array $arguments,
        string $expectedModelClass,
        array $responseBody,
        ?array $expectedArguments = null
    ): void {
        $models          = array_map(
            fn(): MockObject => $this->modelDouble($expectedModelClass),
            $responseBody
        );
        $serviceProvider = new RecordingServiceProvider(
            [
                $expectedModelClass => $models,
            ]
        );
        $resource        = new $resourceClass($this->newClient($serviceProvider, $responseBody));

        $result = $resource->{$method}(...$arguments);

        self::assertCount(count($responseBody), $result);
        foreach ($result as $model) {
            self::assertInstanceOf($expectedModelClass, $model);
        }

        if ($expectedArguments === null) {
            self::assertSame(
                array_map(
                    static fn(array $payload): array => [
                        'type'      => $expectedModelClass,
                        'arguments' => $payload,
                    ],
                    $responseBody
                ),
                $serviceProvider->calls
            );
            return;
        }

        foreach ($serviceProvider->calls as $index => $call) {
            self::assertSame($expectedModelClass, $call['type']);
            foreach (($expectedArguments[$index] ?? []) as $key => $value) {
                self::assertArrayHasKey($key, $call['arguments']);
                self::assertSame(
                    $this->resolveExpectedArgument($value, $serviceProvider, $resource),
                    $call['arguments'][$key]
                );
            }
        }
    }

    /**
     * @dataProvider wrappedResultProvider
     * @param class-string $resourceClass
     * @param list<mixed> $arguments
     */
    public function testWrappedResponsesHydrateCollections(
        string $resourceClass,
        string $method,
        array $arguments,
        string $expectedResultClass,
        string $expectedModelClass,
        array $responseBody,
        array $expectedArguments = []
    ): void {
        $models          = $this->responseItems($responseBody);
        $serviceProvider = new RecordingServiceProvider(
            [
                $expectedModelClass => array_map(
                    fn(): MockObject => $this->modelDouble($expectedModelClass),
                    $models
                ),
            ]
        );
        $resource        = new $resourceClass($this->newClient($serviceProvider, $responseBody));

        $result = $resource->{$method}(...$arguments);

        self::assertInstanceOf($expectedResultClass, $result);
        self::assertSame(count($models), count($serviceProvider->calls));

        foreach ($serviceProvider->calls as $index => $call) {
            self::assertSame($expectedModelClass, $call['type']);
            foreach (($expectedArguments[$index] ?? []) as $key => $value) {
                self::assertArrayHasKey($key, $call['arguments']);
                self::assertSame(
                    $this->resolveExpectedArgument($value, $serviceProvider, $resource),
                    $call['arguments'][$key]
                );
            }
        }
    }

    /**
     * @return iterable<string, array{class-string, string, list<mixed>, class-string, array<string, mixed>, ?array<mixed, mixed>}>
     */
    public static function directModelProvider(): iterable
    {
        yield 'brand update by name' => [
            BrandResource::class,
            'updateBrandByName',
            [['name' => 'Brand']],
            Brand::class,
            ['id' => 'b-1', 'name' => 'Brand'],
            null,
        ];

        yield 'order by id' => [
            OrderResource::class,
            'loadByOrderId',
            ['ord-1'],
            OrderApi::class,
            ['id' => 'ord-1', 'channel' => 'site', 'externalId' => 'ext', 'freightType' => 'NORMAL', 'invoices' => [], 'items' => [], 'orderType' => 'SALE', 'payments' => [], 'shipments' => [], 'statusHistory' => [], 'tags' => []],
            null,
        ];

        yield 'product v2 by sku id' => [
            ProductV2Resource::class,
            'getApiProductBySkyId',
            ['sku-1'],
            ProductV2::class,
            ['status' => 'ACTIVE', 'type' => 'SIMPLE', 'specifications' => [], 'variations' => [], 'variantAttributes' => [], 'kitAssociations' => [], 'categoryIds' => []],
            null,
        ];

        yield 'promotion create' => [
            PromotionResource::class,
            'createPromotion',
            [['name' => 'Summer']],
            Promotion::class,
            ['id' => 'promo-1', 'name' => 'Summer'],
            null,
        ];

        yield 'shipping quote' => [
            FreightQuoteResource::class,
            'quote',
            ['seller-1', 12345000, ['items' => []]],
            ShippingQuotesApi::class,
            ['quotes' => []],
            null,
        ];

        yield 'logistic type mapping' => [
            LogisticTypeMappingResource::class,
            'getLogisticTypeMapping',
            ['AMZ'],
            LogisticTypeMappingApi::class,
            ['entries' => []],
            null,
        ];

        yield 'sku resolve by skuId' => [
            SkuResolveResource::class,
            'resolveSkuBySkuId',
            ['sku-id-1'],
            VariationSkuApiMap::class,
            ['sku' => 'SKU-1', 'skuId' => 'sku-id-1'],
            null,
        ];

        yield 'tag group by id' => [
            TagResource::class,
            'findById',
            ['group-1'],
            TagGroupApi::class,
            ['id' => 'group-1'],
            null,
        ];

        yield 'category by id' => [
            CategoryResource::class,
            'loadById',
            ['cat-1'],
            Category::class,
            ['id' => 'cat-1', 'name' => 'Category'],
            null,
        ];

        yield 'category create' => [
            CategoryResource::class,
            'create',
            [
                [
                    '__mock_model_class' => Category::class,
                    'payload'            => ['id' => 'cat-1', 'name' => 'Category'],
                ],
            ],
            Category::class,
            ['id' => 'cat-1', 'name' => 'Category'],
            null,
        ];

        yield 'token revalidate hydrates token' => [
            TokenResource::class,
            'revalidate',
            ['plain-token'],
            Token::class,
            ['accessToken' => 'renewed'],
            null,
        ];

        yield 'product create' => [
            ProductResource::class,
            'create',
            [
                [
                    '__mock_model_class' => Product::class,
                    'payload'            => ['id' => 'prod-1'],
                ],
            ],
            Product::class,
            ['id' => 'prod-1'],
            ['id' => 'prod-1'],
        ];

        yield 'invoicer find by id' => [
            InvoiceResource::class,
            'findById_1',
            ['inv-1'],
            Invoice::class,
            ['id' => 'inv-1'],
            null,
        ];

        yield 'order cancel' => [
            OrderResource::class,
            'cancelOrder',
            ['ord-1'],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'order create' => [
            OrderResource::class,
            'createOrder',
            [['id' => 'ord-1']],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'order delivered' => [
            OrderResource::class,
            'updateDelivered',
            ['ord-1', 'ship-1', new DateTimeImmutable('2024-01-01T00:00:00+00:00')],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'order invoiced' => [
            OrderResource::class,
            'updateInvoiced',
            ['ord-1', ['invoice' => '1']],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'order paid' => [
            OrderResource::class,
            'updatePaid',
            ['ord-1'],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'order returned' => [
            OrderResource::class,
            'updateReturned',
            ['ord-1', 'RETURNED'],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'order shipped' => [
            OrderResource::class,
            'updateShipped',
            ['ord-1', ['shipment' => '1']],
            OrderApi::class,
            ['id' => 'ord-1'],
            null,
        ];

        yield 'promotion ids search' => [
            PromotionResource::class,
            'searchPromotionIds',
            [['sellerId' => 'seller-1']],
            StringList::class,
            ['p-1', 'p-2'],
            ['values' => ['p-1', 'p-2']],
        ];

        yield 'promotion finish' => [
            PromotionResource::class,
            'finishPromotions',
            [['p-1', 'p-2']],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'promotion activate' => [
            PromotionResource::class,
            'activatePromotions',
            [['p-1', 'p-2']],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'image resize url' => [
            ImageResource::class,
            'resizeImageUrl',
            ['seller-1', '200x200', 'https://example.test/img.png'],
            StringValue::class,
            'https://cdn.example.test/presigned',
            ['value' => 'https://cdn.example.test/presigned'],
        ];

        yield 'invoice download url' => [
            \Gubee\SDK\Resource\InvoiceResource::class,
            'getDownloadUrl_1',
            ['inv-1'],
            StringValue::class,
            'https://cdn.example.test/invoice.pdf',
            ['value' => 'https://cdn.example.test/invoice.pdf'],
        ];

        yield 'invoicer sale invoice order' => [
            InvoiceResource::class,
            'saleInvoiceOrder',
            [['orderId' => 'ord-1']],
            StringValue::class,
            'invoice-1',
            ['value' => 'invoice-1'],
        ];

        yield 'invoicer request invoice authorization' => [
            InvoiceResource::class,
            'requestInvoiceAuthorization',
            ['inv-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'invoicer reversal invoice order' => [
            InvoiceResource::class,
            'reversalInvoiceOrder',
            [['invoiceId' => 'inv-1']],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'invoicer devolution invoice order' => [
            InvoiceResource::class,
            'devolutionInvoiceOrder',
            [['invoiceId' => 'inv-1']],
            StringValue::class,
            'invoice-2',
            ['value' => 'invoice-2'],
        ];

        yield 'invoicer send correction letter' => [
            InvoiceResource::class,
            'sendCorrectionLetter',
            ['inv-1', 'payload'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'invoicer complementary invoice' => [
            InvoiceResource::class,
            'complementaryInvoice',
            [['invoiceId' => 'inv-1']],
            StringValue::class,
            'invoice-3',
            ['value' => 'invoice-3'],
        ];

        yield 'invoicer request invoice order' => [
            InvoiceResource::class,
            'requestInvoiceOrder',
            ['inv-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'invoicer download danfe' => [
            InvoiceResource::class,
            'downloadDanfe',
            ['inv-1'],
            StringValue::class,
            'https://cdn.example.test/danfe.pdf',
            ['value' => 'https://cdn.example.test/danfe.pdf'],
        ];

        yield 'invoicer cancel invoice' => [
            InvoiceResource::class,
            'cancelInvoice',
            ['inv-1', 'payload'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'tag download url' => [
            TagResource::class,
            'getDownloadUrl',
            ['pkg-1', 'PDF'],
            StringValue::class,
            'https://cdn.example.test/tag.pdf',
            ['value' => 'https://cdn.example.test/tag.pdf'],
        ];

        yield 'tag pending ids' => [
            TagResource::class,
            'searchIdsPendingTagsOfOrders',
            ['HUBEE'],
            StringList::class,
            ['ord-1', 'ord-2'],
            ['values' => ['ord-1', 'ord-2']],
        ];

        yield 'tag merge packages' => [
            TagResource::class,
            'mergePackages',
            ['group-1', 'PDF'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'tag download merged packages' => [
            TagResource::class,
            'downloadMergedPackages',
            ['group-1', 'PDF'],
            StringValue::class,
            'https://cdn.example.test/merged.pdf',
            ['value' => 'https://cdn.example.test/merged.pdf'],
        ];

        yield 'ad origin sku id map' => [
            AdResource::class,
            'mapOriginSkuIds',
            [['ad-1', 'ad-2']],
            StringMap::class,
            ['ad-1' => 'sku-1', 'ad-2' => 'sku-2'],
            ['values' => ['ad-1' => 'sku-1', 'ad-2' => 'sku-2']],
        ];

        yield 'ad update description by origin sku id' => [
            AdResource::class,
            'updateDescriptionByOriginSkuId',
            ['sku-1', ['title' => 'T', 'description' => 'D']],
            StringList::class,
            ['updated'],
            ['values' => ['updated']],
        ];

        yield 'ad search origin sku ids' => [
            AdResource::class,
            'searchOriginSkuIds',
            ['HUBEE', true, ['sellerId' => 'seller-1']],
            StringList::class,
            ['sku-1', 'sku-2'],
            ['values' => ['sku-1', 'sku-2']],
        ];

        yield 'ad find origin sku ids by ad ids' => [
            AdResource::class,
            'findAllOriginSkuIdByAdIds',
            [['ad-1', 'ad-2']],
            StringList::class,
            ['sku-1', 'sku-2'],
            ['values' => ['sku-1', 'sku-2']],
        ];

        yield 'brand delete by external id' => [
            BrandResource::class,
            'deleteBrandByExternalId',
            ['brand-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'price update by sku id' => [
            PriceResource::class,
            'updatePriceBySkuId',
            [
                'prod-1',
                'sku-1',
                [
                    '__mock_model_class' => Price::class,
                    'payload'            => ['type' => 'DEFAULT', 'value' => 9.9],
                ],
            ],
            Price::class,
            ['type' => 'DEFAULT', 'value' => 9.9],
            null,
        ];

        yield 'price update by sku' => [
            PriceResource::class,
            'updatePricesBySku',
            [['sku' => 'SKU-1', 'prices' => []]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'price update v2' => [
            PriceResource::class,
            'updatePriceV2',
            [['skuId' => 'sku-1', 'productId' => 'prod-1', 'value' => 9.9]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'price update list v2' => [
            PriceResource::class,
            'updatePricesV2',
            [['skuId' => 'sku-1', 'productId' => 'prod-1', 'prices' => []]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'price update single by sku' => [
            PriceResource::class,
            'updatePriceBySku',
            [['sku' => 'SKU-1', 'price' => ['type' => 'DEFAULT', 'value' => 9.9]]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'stock update' => [
            StockResource::class,
            'updateStock',
            [
                'prod-1',
                'sku-1',
                [
                    '__mock_model_class' => Stock::class,
                    'payload'            => ['qty' => 5],
                ],
            ],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'stock update by sku' => [
            StockResource::class,
            'updateStockBySku',
            [['sku' => 'SKU-1', 'qty' => 5]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'stock update v2' => [
            StockResource::class,
            'updateStockV2',
            [['skuId' => 'sku-1', 'productId' => 'prod-1', 'qty' => 5]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'product v2 create or update full product' => [
            ProductV2Resource::class,
            'createorupdatefullproduct',
            [['status' => 'ACTIVE', 'type' => 'SIMPLE', 'specifications' => [], 'variations' => [], 'variantAttributes' => [], 'kitAssociations' => [], 'categoryIds' => []]],
            ProductV2::class,
            ['status' => 'ACTIVE', 'type' => 'SIMPLE', 'specifications' => [], 'variations' => [], 'variantAttributes' => [], 'kitAssociations' => [], 'categoryIds' => []],
            null,
        ];

        yield 'product update' => [
            ProductResource::class,
            'update',
            [
                'prod-1',
                [
                    '__mock_model_class' => Product::class,
                    'payload'            => ['id' => 'prod-1'],
                ],
            ],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'product delete' => [
            ProductResource::class,
            'deleteById',
            ['prod-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'product update by main sku id' => [
            ProductResource::class,
            'updateProductByMainSkuId',
            ['MAIN-1', ['id' => 'prod-1']],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'product patch video metadata' => [
            ProductResource::class,
            'patchVideoMetadataByExternalId',
            ['ext-1', 'sku-1', 'vid-1', ['main' => true]],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'image resize binary' => [
            ImageResource::class,
            'resizeImageBinary',
            ['seller-1', '200x200', 'https://example.test/img.png'],
            StringValue::class,
            'binary-image',
            ['value' => 'binary-image'],
        ];

        yield 'invoicer preview danfe' => [
            InvoiceResource::class,
            'previewDanfe',
            [['orderId' => 'ord-1']],
            StringValue::class,
            '%PDF-1.4',
            ['value' => '%PDF-1.4'],
        ];

        yield 'invoicer correction letter file' => [
            InvoiceResource::class,
            'getCorrectionLetterFile',
            ['inv-1', 'PDF'],
            StringValue::class,
            '%PDF-1.4',
            ['value' => '%PDF-1.4'],
        ];

        yield 'notification mark as read' => [
            NotificationResource::class,
            'markAsRead',
            ['n-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'order queue delete' => [
            QueueResource::class,
            'deleteOrderFromQueue',
            ['CREATED', 'ord-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'queue remove canceled order' => [
            \Gubee\SDK\Resource\Sales\Order\Queue\NotificationResource::class,
            'removeCanceledOrder',
            ['ord-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'queue remove rejected order' => [
            \Gubee\SDK\Resource\Sales\Order\Queue\NotificationResource::class,
            'removeRejectedOrder',
            ['ord-1'],
            EmptyResult::class,
            [],
            [],
        ];

        yield 'video delete' => [
            VideoResource::class,
            'videoIntegrationDelete',
            ['vid-1'],
            EmptyResult::class,
            [],
            [],
        ];
    }

    /**
     * @return iterable<string, array{class-string, string, list<mixed>, class-string, list<array<string, mixed>>, ?array<mixed>}>
     */
    public static function collectionProvider(): iterable
    {
        yield 'platform configuration list' => [
            PlatformResource::class,
            'configuration',
            [],
            PlatformConfigurationApi::class,
            [
                ['name' => 'cfg-a'],
                ['name' => 'cfg-b'],
            ],
            null,
        ];

        yield 'product sku map list' => [
            ProductResource::class,
            'findSkusBySkuIdsPost',
            [['sku-id-1']],
            VariationSkuApiMap::class,
            [
                ['sku' => 'SKU-1', 'skuId' => 'sku-id-1'],
                ['sku' => 'SKU-2', 'skuId' => 'sku-id-2'],
            ],
            null,
        ];

        yield 'video status list' => [
            VideoResource::class,
            'videoIntegrationList',
            [],
            VideoStatus::class,
            [
                ['id' => 'vid-1', 'status' => 'PROCESSING'],
                ['id' => 'vid-2', 'status' => 'READY'],
            ],
            null,
        ];

        yield 'platform blacklist list' => [
            PlatformResource::class,
            'createdBlacklist',
            [],
            BlacklistPlatformApi::class,
            [
                ['value' => '111'],
                ['value' => '222'],
            ],
            null,
        ];

        yield 'invoice list by order id' => [
            \Gubee\SDK\Resource\InvoiceResource::class,
            'listInvoiceByOrderId',
            ['ord-1'],
            InvoiceApiModel::class,
            [
                ['id' => 'inv-1'],
                ['id' => 'inv-2'],
            ],
            null,
        ];

        yield 'tag package list' => [
            TagResource::class,
            'findAllTagPackages',
            ['group-1'],
            TagPackageApi::class,
            [
                ['id' => 'pkg-1'],
                ['id' => 'pkg-2'],
            ],
            null,
        ];

        yield 'ads by origin sku ids' => [
            AdResource::class,
            'listAdsByOriginSkuIds',
            [['sku-1', 'sku-2']],
            Ad::class,
            [
                ['id' => 'ad-1'],
                ['id' => 'ad-2'],
            ],
            null,
        ];

        yield 'price by item ids list' => [
            PriceResource::class,
            'getPricesByItemIds',
            [['item-1', 'item-2']],
            SkuPrice::class,
            [
                ['itemId' => 'item-1', 'sellerId' => 'seller-1', 'domain' => 'PRODUCT', 'prices' => []],
                ['itemId' => 'item-2', 'sellerId' => 'seller-1', 'domain' => 'PRODUCT', 'prices' => []],
            ],
            [
                ['serviceProvider' => '__service_provider__'],
                ['serviceProvider' => '__service_provider__'],
            ],
        ];

        yield 'price list by sku id update' => [
            PriceResource::class,
            'updatePricesBySkuId',
            ['prod-1', 'sku-1', [['type' => 'DEFAULT', 'value' => 1.5]]],
            Price::class,
            [
                ['type' => 'DEFAULT', 'value' => 1.5],
                ['type' => 'PROMOTION', 'value' => 0.9],
            ],
            [
                [
                    'priceResource'   => '__resource_instance__',
                    'serviceProvider' => '__service_provider__',
                ],
                [
                    'priceResource'   => '__resource_instance__',
                    'serviceProvider' => '__service_provider__',
                ],
            ],
        ];

        yield 'stock by sku list' => [
            StockResource::class,
            'getStockBySku',
            ['SKU-1'],
            StockQuery::class,
            [
                ['id' => 'stock-1', 'sellerId' => 'seller-1', 'itemId' => 'item-1', 'warehouseId' => 'wh-1', 'qty' => 5, 'booking' => 0, 'priority' => 1, 'stockType' => 'DEFAULT', 'domainType' => 'PRODUCT', 'crossDockingTime' => 'P1D'],
                ['id' => 'stock-2', 'sellerId' => 'seller-1', 'itemId' => 'item-1', 'warehouseId' => 'wh-2', 'qty' => 3, 'booking' => 0, 'priority' => 2, 'stockType' => 'DEFAULT', 'domainType' => 'PRODUCT', 'crossDockingTime' => 'P1D'],
            ],
            null,
        ];

        yield 'product v2 by sku ids' => [
            ProductV2Resource::class,
            'getApiProductBySkyIds',
            [['sku-1', 'sku-2']],
            ProductV2::class,
            [
                ['status' => 'ACTIVE', 'type' => 'SIMPLE', 'specifications' => [], 'variations' => [], 'variantAttributes' => [], 'kitAssociations' => [], 'categoryIds' => []],
                ['status' => 'INACTIVE', 'type' => 'SIMPLE', 'specifications' => [], 'variations' => [], 'variantAttributes' => [], 'kitAssociations' => [], 'categoryIds' => []],
            ],
            null,
        ];

        yield 'product sku map list get' => [
            ProductResource::class,
            'findSkusBySkuIds',
            [['sku-id-1']],
            VariationSkuApiMap::class,
            [
                ['sku' => 'SKU-1', 'skuId' => 'sku-id-1'],
                ['sku' => 'SKU-2', 'skuId' => 'sku-id-2'],
            ],
            null,
        ];

        yield 'product sku ids by skus get' => [
            ProductResource::class,
            'findSkuIdsBySkus',
            [['SKU-1', 'SKU-2']],
            VariationSkuApiMap::class,
            [
                ['sku' => 'SKU-1', 'skuId' => 'sku-id-1'],
                ['sku' => 'SKU-2', 'skuId' => 'sku-id-2'],
            ],
            null,
        ];
    }

    /**
     * @return iterable<string, array{class-string, string, list<mixed>, array<mixed, mixed>}>
     */
    public static function wrappedResultProvider(): iterable
    {
        yield 'category pageable list hydrates categories' => [
            CategoryResource::class,
            'listAll_1',
            [['page' => 0, 'size' => 10]],
            PagedResult::class,
            Category::class,
            [
                '_embedded' => [
                    'categoryApiDTOList' => [
                        ['id' => 'cat-1', 'name' => 'Category A'],
                        ['id' => 'cat-2', 'name' => 'Category B'],
                    ],
                ],
                'page'      => ['totalElements' => 2],
            ],
            [
                [
                    'serviceProvider'  => '__service_provider__',
                    'categoryResource' => '__resource_instance__',
                ],
                [
                    'serviceProvider'  => '__service_provider__',
                    'categoryResource' => '__resource_instance__',
                ],
            ],
        ];

        yield 'brand pageable list hydrates brands' => [
            BrandResource::class,
            'listAllBrands',
            [['page' => 0, 'size' => 10]],
            PagedResult::class,
            Brand::class,
            [
                '_embedded' => [
                    'brandApiDTOList' => [
                        ['name' => 'Brand A'],
                        ['name' => 'Brand B'],
                    ],
                ],
                'page'      => ['totalElements' => 2],
            ],
            [
                ['brandResource' => '__resource_instance__'],
                ['brandResource' => '__resource_instance__'],
            ],
        ];

        yield 'attribute group pageable list hydrates groups' => [
            AttributeGroupResource::class,
            'listAllAttributeGroups',
            [['page' => 0, 'size' => 10]],
            PagedResult::class,
            AttributeGroupApi::class,
            [
                '_embedded' => [
                    'attributeGroupApiDTOList' => [
                        ['name' => 'group-a', 'attributes' => []],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];

        yield 'attribute pageable list hydrates attributes' => [
            AttributeResource::class,
            'listAll_2',
            [['page' => 0, 'size' => 10]],
            PagedResult::class,
            Attribute::class,
            [
                '_embedded' => [
                    'attributeApiDTOList' => [
                        ['name' => 'color', 'attrType' => 'TEXT', 'options' => [], 'required' => false, 'variant' => false],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];

        yield 'product search hydrates paged products' => [
            ProductResource::class,
            'search',
            [['status' => 'ACTIVE']],
            PagedResult::class,
            Product::class,
            [
                '_embedded' => [
                    'products' => [
                        ['id' => 'prod-1'],
                        ['id' => 'prod-2'],
                    ],
                ],
                'page'      => ['totalElements' => 2],
            ],
            [
                [
                    'serviceProvider' => '__service_provider__',
                    'productResource' => '__resource_instance__',
                ],
                [
                    'serviceProvider' => '__service_provider__',
                    'productResource' => '__resource_instance__',
                ],
            ],
        ];

        yield 'product listAll hydrates paged products' => [
            ProductResource::class,
            'listAll',
            [],
            PagedResult::class,
            Product::class,
            [
                '_embedded' => [
                    'objectList' => [
                        ['id' => 'prod-1'],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [
                [
                    'serviceProvider' => '__service_provider__',
                    'productResource' => '__resource_instance__',
                ],
            ],
        ];

        yield 'notification missed hydrates paged notifications' => [
            NotificationResource::class,
            'missed',
            ['store-a', ['page' => 0, 'size' => 10]],
            PagedResult::class,
            MissedNotification::class,
            [
                '_embedded' => [
                    'missedNotificationApiDTOList' => [
                        ['id' => 'n-1', 'resource' => 'orders', 'sellerId' => 'seller', 'domain' => 'sales', 'endpointId' => 'ep-1', 'type' => 'POST', 'attempts' => 1],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [
                ['serviceProvider' => '__service_provider__'],
            ],
        ];

        yield 'promotion search hydrates paged promotions' => [
            PromotionResource::class,
            'searchPromotions',
            [['page' => 0, 'size' => 10], ['sellerId' => 'seller-1']],
            PagedResult::class,
            Promotion::class,
            [
                '_embedded' => [
                    'objectList' => [
                        ['id' => 'promo-1', 'name' => 'Summer'],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [
                ['serviceProvider' => '__service_provider__'],
            ],
        ];

        yield 'promotion list hydrates paged promotions' => [
            PromotionResource::class,
            'listPromotions',
            [['page' => 0, 'size' => 10]],
            PagedResult::class,
            Promotion::class,
            [
                '_embedded' => [
                    'objectList' => [
                        ['id' => 'promo-1', 'name' => 'Summer'],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [
                ['serviceProvider' => '__service_provider__'],
            ],
        ];

        yield 'tag pending scroll hydrates order tags' => [
            TagResource::class,
            'searchPendingTagsOfOrders',
            ['HUBEE'],
            ScrollResult::class,
            OrderTagApi::class,
            [
                'content'       => [
                    ['id' => 'tag-1'],
                    ['id' => 'tag-2'],
                ],
                'scrollId'      => 'scroll-1',
                'pageSize'      => 2,
                'totalElements' => 10,
            ],
            [],
        ];

        yield 'tag pending pageable hydrates order tags' => [
            TagResource::class,
            'searchPendingTagsOfOrdersPageable',
            ['HUBEE', null, null, null, null, null, ['page' => 0, 'size' => 10]],
            PagedResult::class,
            OrderTagApi::class,
            [
                '_embedded' => [
                    'orderTagApiDTOList' => [
                        ['id' => 'tag-1'],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];

        yield 'tag group scroll hydrates tag groups' => [
            TagResource::class,
            'findAllTagGroup',
            ['HUBEE'],
            ScrollResult::class,
            TagGroupApi::class,
            [
                'content'       => [
                    ['ordersGroup' => []],
                ],
                'scrollId'      => 'scroll-1',
                'pageSize'      => 1,
                'totalElements' => 5,
            ],
            [],
        ];

        yield 'queue status list hydrates paged orders' => [
            QueueResource::class,
            'listOrdersByStatusQueue',
            ['CREATED', ['page' => 0, 'size' => 10]],
            PagedResult::class,
            OrderApi::class,
            [
                '_embedded' => [
                    'orders' => [
                        ['id' => 'ord-1', 'channel' => 'site', 'externalId' => 'ext-1', 'freightType' => 'NORMAL', 'invoices' => [], 'items' => [], 'orderType' => 'SALE', 'payments' => [], 'shipments' => [], 'statusHistory' => [], 'tags' => []],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];

        yield 'queue rejected list hydrates paged rejected orders' => [
            QueueResource::class,
            'listRejectedQueueOrders',
            [['page' => 0, 'size' => 10]],
            PagedResult::class,
            RejectedOrder::class,
            [
                '_embedded' => [
                    'rejectedOrders' => [
                        ['orderId' => 'ord-1', 'externalId' => 'ext-1', 'marketplace' => 'AMZ', 'rejectedOrderStatus' => []],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];

        yield 'queue canceled orders hydrates paged orders' => [
            \Gubee\SDK\Resource\Sales\Order\Queue\NotificationResource::class,
            'getCanceledOrders',
            [],
            PagedResult::class,
            OrderApi::class,
            [
                '_embedded' => [
                    'orders' => [
                        ['id' => 'ord-1', 'channel' => 'site', 'externalId' => 'ext-1', 'freightType' => 'NORMAL', 'invoices' => [], 'items' => [], 'orderType' => 'SALE', 'payments' => [], 'shipments' => [], 'statusHistory' => [], 'tags' => []],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];

        yield 'queue rejected orders hydrates paged rejected orders' => [
            \Gubee\SDK\Resource\Sales\Order\Queue\NotificationResource::class,
            'getRejectedOrders',
            [],
            PagedResult::class,
            RejectedOrder::class,
            [
                '_embedded' => [
                    'rejectedOrders' => [
                        ['orderId' => 'ord-1', 'externalId' => 'ext-1', 'marketplace' => 'AMZ', 'rejectedOrderStatus' => []],
                    ],
                ],
                'page'      => ['totalElements' => 1],
            ],
            [],
        ];
    }

    /**
     * @param class-string $className
     * @return object&MockObject
     */
    private function modelDouble(string $className)
    {
        return $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param mixed $argument
     * @return mixed
     */
    private function resolveArgument($argument)
    {
        if (! is_array($argument) || ! isset($argument['__mock_model_class'])) {
            return $argument;
        }

        $mock = $this->getMockBuilder($argument['__mock_model_class'])
            ->disableOriginalConstructor()
            ->onlyMethods(['jsonSerialize'])
            ->getMock();
        $mock->method('jsonSerialize')->willReturn($argument['payload']);

        return $mock;
    }

    /**
     * @param array<string, mixed> $responseBody
     * @return list<array<string, mixed>>
     */
    private function responseItems(array $responseBody): array
    {
        if (isset($responseBody['content']) && is_array($responseBody['content'])) {
            return $responseBody['content'];
        }

        if (isset($responseBody['_embedded']) && is_array($responseBody['_embedded'])) {
            foreach ($responseBody['_embedded'] as $items) {
                if (is_array($items)) {
                    return $items;
                }
            }
        }

        return [];
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function resolveExpectedArgument($value, RecordingServiceProvider $serviceProvider, object $resource)
    {
        if ($value === '__service_provider__') {
            return $serviceProvider;
        }

        if ($value === '__resource_instance__') {
            return $resource;
        }

        return $value;
    }

    /**
     * @param mixed $responseBody
     */
    private function newClient(RecordingServiceProvider $serviceProvider, $responseBody): Client
    {
        $httpClient = new StaticResponseHttpClient(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                (string) json_encode($responseBody)
            )
        );

        $client = new Client($serviceProvider, null, new Builder($httpClient), 0);
        $client->setUrl('https://example.test');

        return $client;
    }
}

final class RecordingServiceProvider implements ServiceProviderInterface
{
    /** @var list<array{type:string, arguments:array<mixed, mixed>}> */
    public array $calls = [];

    /** @var array<class-string, list<object>> */
    private array $instancesByType;

    /**
     * @param array<class-string, list<object>> $instancesByType
     */
    public function __construct(array $instancesByType)
    {
        $this->instancesByType = $instancesByType;
    }

    public function get($id)
    {
        throw new class ('Not implemented for this test.') extends RuntimeException implements NotFoundExceptionInterface {
        };
    }

    public function has($id): bool
    {
        return false;
    }

    public function create(string $type, array $arguments = [])
    {
        $this->calls[] = [
            'type'      => $type,
            'arguments' => $arguments,
        ];

        if (! isset($this->instancesByType[$type][0])) {
            throw new RuntimeException('No test double registered for ' . $type);
        }

        return array_shift($this->instancesByType[$type]);
    }
}

final class StaticResponseHttpClient implements ClientInterface
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->response;
    }
}
