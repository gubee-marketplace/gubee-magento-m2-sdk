<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Ad\Ad;

use function is_array;

class AdGroupApi extends AbstractModel
{
    protected Ad $ad;

    /** @var array<Ad> */

    protected array $associateAds;

    /**
     * @param Ad|array<mixed> $ad
     * @param array<Ad|array<mixed>> $associateAds
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        Ad|array $ad,
        array $associateAds
    ) {
        if (is_array($ad)) {
            $ad = $serviceProvider->create(
                Ad::class,
                $ad
            );
        }
        $this->setAd($ad);
        foreach ($associateAds as $key => $value) {
            if (is_array($value)) {
                $associateAds[$key] = $serviceProvider->create(
                    Ad::class,
                    $value
                );
            }
        }
        $this->setAssociateAds($associateAds);
    }

    public function getAd(): Ad
    {
        return $this->ad;
    }

    public function setAd(Ad $ad): self
    {
        $this->ad = $ad;
        return $this;
    }

    /**
     * @return array<Ad>
     */
    public function getAssociateAds(): array
    {
        return $this->associateAds;
    }

    /**
     * @param array<Ad> $associateAds
     */
    public function setAssociateAds(array $associateAds): self
    {
        $this->validateArrayElements($associateAds, Ad::class);
        $this->associateAds = $associateAds;
        return $this;
    }
}
