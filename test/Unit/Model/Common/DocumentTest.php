<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Enum\Common\DocumentTypeEnum;
use Gubee\SDK\Model\Common\Document;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    public function testConstructorWithStringType(): void
    {
        $document = new Document('123456', 'CPF', 'id-1', 'value-1');

        $this->assertSame('123456', $document->getNumber());
        $this->assertInstanceOf(DocumentTypeEnum::class, $document->getType());
        $this->assertSame('CPF', (string) $document->getType());
        $this->assertSame('id-1', $document->getId());
        $this->assertSame('value-1', $document->getValue());
    }

    public function testConstructorWithEnumInstance(): void
    {
        $document = new Document('123456', DocumentTypeEnum::CNPJ());

        $this->assertSame('CNPJ', (string) $document->getType());
    }

    public function testConstructorWithDefaults(): void
    {
        $document = new Document();

        $this->assertNull($document->getNumber());
        $this->assertNull($document->getType());
        $this->assertNull($document->getId());
        $this->assertNull($document->getValue());
    }

    public function testSetters(): void
    {
        $document = new Document();

        $document->setNumber('654321');
        $document->setType(DocumentTypeEnum::RG());
        $document->setId('id-2');
        $document->setValue('value-2');

        $this->assertSame('654321', $document->getNumber());
        $this->assertSame('RG', (string) $document->getType());
        $this->assertSame('id-2', $document->getId());
        $this->assertSame('value-2', $document->getValue());
    }
}
