<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\ValidateProductMessageApi;

use function is_array;

class ValidateProductResponseApi extends AbstractModel
{
    protected bool $valid;

    /** @var array<ValidateProductMessageApi>|null */

    protected ?array $messages = null;

    /**
     * @param array<ValidateProductMessageApi|array<mixed>>|null $messages
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        bool $valid,
        ?array $messages = null
    ) {
        $this->setValid($valid);
        if ($messages !== null) {
            foreach ($messages as $key => $value) {
                if (is_array($value)) {
                    $messages[$key] = $serviceProvider->create(
                        ValidateProductMessageApi::class,
                        $value
                    );
                }
            }
            $this->setMessages($messages);
        }
    }

    public function getValid(): bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;
        return $this;
    }

    /**
     * @return array<ValidateProductMessageApi>|null
     */
    public function getMessages(): ?array
    {
        return $this->messages;
    }

    /**
     * @param array<ValidateProductMessageApi> $messages
     */
    public function setMessages(?array $messages): self
    {
        if ($messages !== null) {
            $this->validateArrayElements($messages, ValidateProductMessageApi::class);
        }
        $this->messages = $messages;
        return $this;
    }
}
