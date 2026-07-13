<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Tag;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Tag\PackageErrorApi;
use Gubee\SDK\Model\Tag\PackApi;

use function is_array;

class TagPackageApi extends AbstractModel
{
    protected ?string $id = null;

    /** @var array<string> */

    protected array $packageOrders;

    /** @var array<PackageErrorApi> */

    protected array $errors;

    /** @var array<PackApi> */

    protected array $packs;

    /**
     * @param array<string> $packageOrders
     * @param array<PackageErrorApi|array<mixed>> $errors
     * @param array<PackApi|array<mixed>> $packs
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $id = null,
        array $packageOrders,
        array $errors,
        array $packs
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setPackageOrders($packageOrders);
        foreach ($errors as $key => $value) {
            if (is_array($value)) {
                $errors[$key] = $serviceProvider->create(
                    PackageErrorApi::class,
                    $value
                );
            }
        }
        $this->setErrors($errors);
        foreach ($packs as $key => $value) {
            if (is_array($value)) {
                $packs[$key] = $serviceProvider->create(
                    PackApi::class,
                    $value
                );
            }
        }
        $this->setPacks($packs);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getPackageOrders(): array
    {
        return $this->packageOrders;
    }

    /**
     * @param array<string> $packageOrders
     */
    public function setPackageOrders(array $packageOrders): self
    {
        $this->validateArrayElements($packageOrders, 'string');
        $this->packageOrders = $packageOrders;
        return $this;
    }

    /**
     * @return array<PackageErrorApi>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array<PackageErrorApi> $errors
     */
    public function setErrors(array $errors): self
    {
        $this->validateArrayElements($errors, PackageErrorApi::class);
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return array<PackApi>
     */
    public function getPacks(): array
    {
        return $this->packs;
    }

    /**
     * @param array<PackApi> $packs
     */
    public function setPacks(array $packs): self
    {
        $this->validateArrayElements($packs, PackApi::class);
        $this->packs = $packs;
        return $this;
    }
}
