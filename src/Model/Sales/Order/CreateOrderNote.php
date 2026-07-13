<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class CreateOrderNote extends AbstractModel
{
    protected string $note;

    public function __construct(
        string $note
    ) {
        $this->setNote($note);
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;
        return $this;
    }
}
