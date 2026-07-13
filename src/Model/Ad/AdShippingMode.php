<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Ad\ShippingConfiguration;

use function is_array;

class AdShippingMode extends AbstractModel
{
    protected string $id;

    protected ?string $name = null;

    /** @var array<string> */

    protected array $options;

    /** @var array<ShippingConfiguration>|null */

    protected ?array $configurations = null;

    /**
     * @param array<string> $options
     * @param array<ShippingConfiguration|array<mixed>>|null $configurations
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $id,
        ?string $name = null,
        array $options,
        ?array $configurations = null
    ) {
        $this->setId($id);
        if ($name !== null) {
            $this->setName($name);
        }
        $this->setOptions($options);
        if ($configurations !== null) {
            foreach ($configurations as $key => $value) {
                if (is_array($value)) {
                    $configurations[$key] = $serviceProvider->create(
                        ShippingConfiguration::class,
                        $value
                    );
                }
            }
            $this->setConfigurations($configurations);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array<string> $options
     */
    public function setOptions(array $options): self
    {
        $this->validateArrayElements($options, 'string');
        $this->options = $options;
        return $this;
    }

    /**
     * @return array<ShippingConfiguration>|null
     */
    public function getConfigurations(): ?array
    {
        return $this->configurations;
    }

    /**
     * @param array<ShippingConfiguration> $configurations
     */
    public function setConfigurations(?array $configurations): self
    {
        if ($configurations !== null) {
            $this->validateArrayElements($configurations, ShippingConfiguration::class);
        }
        $this->configurations = $configurations;
        return $this;
    }
}
