<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Invoice\SearchParams;
use Gubee\SDK\Model\Invoice\SortParam;

use function is_array;

class FindInvoiceFiltered extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?SearchParams $searchParams = null;

    protected ?int $page = null;

    protected ?int $size = null;

    /** @var array<SortParam>|null */

    protected ?array $sort = null;

    /**
     * @param SearchParams|array<mixed>|null $searchParams
     * @param array<SortParam|array<mixed>>|null $sort
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $sellerId = null,
        SearchParams|array|null $searchParams = null,
        ?int $page = null,
        ?int $size = null,
        ?array $sort = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($searchParams !== null) {
            if (is_array($searchParams)) {
                $searchParams = $serviceProvider->create(
                    SearchParams::class,
                    $searchParams
                );
            }
            $this->setSearchParams($searchParams);
        }
        if ($page !== null) {
            $this->setPage($page);
        }
        if ($size !== null) {
            $this->setSize($size);
        }
        if ($sort !== null) {
            foreach ($sort as $key => $value) {
                if (is_array($value)) {
                    $sort[$key] = $serviceProvider->create(
                        SortParam::class,
                        $value
                    );
                }
            }
            $this->setSort($sort);
        }
    }

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getSearchParams(): ?SearchParams
    {
        return $this->searchParams;
    }

    public function setSearchParams(?SearchParams $searchParams): self
    {
        $this->searchParams = $searchParams;
        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;
        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return array<SortParam>|null
     */
    public function getSort(): ?array
    {
        return $this->sort;
    }

    /**
     * @param array<SortParam> $sort
     */
    public function setSort(?array $sort): self
    {
        if ($sort !== null) {
            $this->validateArrayElements($sort, SortParam::class);
        }
        $this->sort = $sort;
        return $this;
    }
}
