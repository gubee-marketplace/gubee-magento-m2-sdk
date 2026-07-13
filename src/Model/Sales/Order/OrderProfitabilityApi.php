<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class OrderProfitabilityApi extends AbstractModel
{
    protected ?float $totalCost = null;

    protected ?float $grossProfit = null;

    protected ?float $grossMarginPct = null;

    protected ?float $totalCommission = null;

    protected ?float $serviceFees = null;

    protected ?float $netShippingCost = null;

    protected ?float $contributionMargin = null;

    protected ?float $contributionMarginPct = null;

    protected ?string $trend = null;

    protected ?float $trendPct = null;

    protected ?bool $hasCostData = null;

    protected ?float $grossOperatingRevenue = null;

    protected ?float $escrowAmount = null;

    protected ?float $tax = null;

    public function __construct(
        ?float $totalCost = null,
        ?float $grossProfit = null,
        ?float $grossMarginPct = null,
        ?float $totalCommission = null,
        ?float $serviceFees = null,
        ?float $netShippingCost = null,
        ?float $contributionMargin = null,
        ?float $contributionMarginPct = null,
        ?string $trend = null,
        ?float $trendPct = null,
        ?bool $hasCostData = null,
        ?float $grossOperatingRevenue = null,
        ?float $escrowAmount = null,
        ?float $tax = null
    ) {
        if ($totalCost !== null) {
            $this->setTotalCost($totalCost);
        }
        if ($grossProfit !== null) {
            $this->setGrossProfit($grossProfit);
        }
        if ($grossMarginPct !== null) {
            $this->setGrossMarginPct($grossMarginPct);
        }
        if ($totalCommission !== null) {
            $this->setTotalCommission($totalCommission);
        }
        if ($serviceFees !== null) {
            $this->setServiceFees($serviceFees);
        }
        if ($netShippingCost !== null) {
            $this->setNetShippingCost($netShippingCost);
        }
        if ($contributionMargin !== null) {
            $this->setContributionMargin($contributionMargin);
        }
        if ($contributionMarginPct !== null) {
            $this->setContributionMarginPct($contributionMarginPct);
        }
        if ($trend !== null) {
            $this->setTrend($trend);
        }
        if ($trendPct !== null) {
            $this->setTrendPct($trendPct);
        }
        if ($hasCostData !== null) {
            $this->setHasCostData($hasCostData);
        }
        if ($grossOperatingRevenue !== null) {
            $this->setGrossOperatingRevenue($grossOperatingRevenue);
        }
        if ($escrowAmount !== null) {
            $this->setEscrowAmount($escrowAmount);
        }
        if ($tax !== null) {
            $this->setTax($tax);
        }
    }

    public function getTotalCost(): ?float
    {
        return $this->totalCost;
    }

    public function setTotalCost(?float $totalCost): self
    {
        $this->totalCost = $totalCost;
        return $this;
    }

    public function getGrossProfit(): ?float
    {
        return $this->grossProfit;
    }

    public function setGrossProfit(?float $grossProfit): self
    {
        $this->grossProfit = $grossProfit;
        return $this;
    }

    public function getGrossMarginPct(): ?float
    {
        return $this->grossMarginPct;
    }

    public function setGrossMarginPct(?float $grossMarginPct): self
    {
        $this->grossMarginPct = $grossMarginPct;
        return $this;
    }

    public function getTotalCommission(): ?float
    {
        return $this->totalCommission;
    }

    public function setTotalCommission(?float $totalCommission): self
    {
        $this->totalCommission = $totalCommission;
        return $this;
    }

    public function getServiceFees(): ?float
    {
        return $this->serviceFees;
    }

    public function setServiceFees(?float $serviceFees): self
    {
        $this->serviceFees = $serviceFees;
        return $this;
    }

    public function getNetShippingCost(): ?float
    {
        return $this->netShippingCost;
    }

    public function setNetShippingCost(?float $netShippingCost): self
    {
        $this->netShippingCost = $netShippingCost;
        return $this;
    }

    public function getContributionMargin(): ?float
    {
        return $this->contributionMargin;
    }

    public function setContributionMargin(?float $contributionMargin): self
    {
        $this->contributionMargin = $contributionMargin;
        return $this;
    }

    public function getContributionMarginPct(): ?float
    {
        return $this->contributionMarginPct;
    }

    public function setContributionMarginPct(?float $contributionMarginPct): self
    {
        $this->contributionMarginPct = $contributionMarginPct;
        return $this;
    }

    public function getTrend(): ?string
    {
        return $this->trend;
    }

    public function setTrend(?string $trend): self
    {
        $this->trend = $trend;
        return $this;
    }

    public function getTrendPct(): ?float
    {
        return $this->trendPct;
    }

    public function setTrendPct(?float $trendPct): self
    {
        $this->trendPct = $trendPct;
        return $this;
    }

    public function getHasCostData(): ?bool
    {
        return $this->hasCostData;
    }

    public function setHasCostData(?bool $hasCostData): self
    {
        $this->hasCostData = $hasCostData;
        return $this;
    }

    public function getGrossOperatingRevenue(): ?float
    {
        return $this->grossOperatingRevenue;
    }

    public function setGrossOperatingRevenue(?float $grossOperatingRevenue): self
    {
        $this->grossOperatingRevenue = $grossOperatingRevenue;
        return $this;
    }

    public function getEscrowAmount(): ?float
    {
        return $this->escrowAmount;
    }

    public function setEscrowAmount(?float $escrowAmount): self
    {
        $this->escrowAmount = $escrowAmount;
        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(?float $tax): self
    {
        $this->tax = $tax;
        return $this;
    }
}
