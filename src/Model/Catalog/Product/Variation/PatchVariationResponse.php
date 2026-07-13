<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Model\AbstractModel;

class PatchVariationResponse extends AbstractModel
{
    protected ?bool $modified = null;

    /** @var array<string>|null */

    protected ?array $publishedEventTypes = null;

    /**
     * @param array<string>|null $publishedEventTypes
     */
    public function __construct(
        ?bool $modified = null,
        ?array $publishedEventTypes = null
    ) {
        if ($modified !== null) {
            $this->setModified($modified);
        }
        if ($publishedEventTypes !== null) {
            $this->setPublishedEventTypes($publishedEventTypes);
        }
    }

    public function getModified(): ?bool
    {
        return $this->modified;
    }

    public function setModified(?bool $modified): self
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getPublishedEventTypes(): ?array
    {
        return $this->publishedEventTypes;
    }

    /**
     * @param array<string> $publishedEventTypes
     */
    public function setPublishedEventTypes(?array $publishedEventTypes): self
    {
        if ($publishedEventTypes !== null) {
            $this->validateArrayElements($publishedEventTypes, 'string');
        }
        $this->publishedEventTypes = $publishedEventTypes;
        return $this;
    }
}
