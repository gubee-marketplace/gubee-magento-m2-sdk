<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Measure;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Weight;

use function is_array;

class Dimension extends AbstractModel
{
    protected Measure $depth;
    protected Measure $height;
    protected Weight $weight;
    protected Measure $width;

    /**
     * @param array<int|string, mixed>|Measure $depth
     * @param array<int|string, mixed>|Measure $height
     * @param array<int|string, mixed>|Weight $weight
     * @param array<int|string, mixed>|Measure $width
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        $depth,
        $height,
        $weight,
        $width
    ) {
        if (is_array($depth)) {
            $depth = $serviceProvider->create(
                Measure::class,
                $depth
            );
        }
        $this->setDepth($depth);
        if (is_array($height)) {
            $height = $serviceProvider->create(
                Measure::class,
                $height
            );
        }
        $this->setHeight($height);
        if (is_array($weight)) {
            $weight = $serviceProvider->create(
                Weight::class,
                $weight
            );
        }
        $this->setWeight($weight);
        if (is_array($width)) {
            $width = $serviceProvider->create(
                Measure::class,
                $width
            );
        }
        $this->setWidth($width);
    }

    public function getDepth(): Measure
    {
        return $this->depth;
    }

    public function setDepth(Measure $depth): self
    {
        $this->depth = $depth;
        return $this;
    }

    public function getHeight(): Measure
    {
        return $this->height;
    }

    public function setHeight(Measure $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

    public function setWeight(Weight $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWidth(): Measure
    {
        return $this->width;
    }

    public function setWidth(Measure $width): self
    {
        $this->width = $width;
        return $this;
    }
}
