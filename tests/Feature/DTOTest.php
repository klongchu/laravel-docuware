<?php

namespace Klongchu\DocuWare\Tests\Feature;

use Klongchu\DocuWare\DTO\Dialog;
use Klongchu\DocuWare\DTO\Document;
use Klongchu\DocuWare\DTO\DocumentField;
use Klongchu\DocuWare\DTO\DocumentPaginator;
use Klongchu\DocuWare\DTO\Field;
use Klongchu\DocuWare\DTO\FileCabinet;
use Klongchu\DocuWare\DTO\TableRow;

uses()->group('dto');

it('create a fake file cabinet', function () {
    $fake = FileCabinet::fake();
    $this->assertInstanceOf(FileCabinet::class, $fake);
});

it('create a fake dialog', function () {
    $fake = Dialog::fake();

    $this->assertInstanceOf(Dialog::class, $fake);
});

it('create a fake field', function () {
    $fake = Field::fake();

    $this->assertInstanceOf(Field::class, $fake);
});

it('create a fake document field', function () {
    $fake = DocumentField::fake();

    $this->assertInstanceOf(DocumentField::class, $fake);
});

it('create a fake document', function () {
    $fake = Document::fake();

    $this->assertInstanceOf(Document::class, $fake);
});

it('create a fake document paginator', function () {
    $fake = DocumentPaginator::fake();

    $this->assertInstanceOf(DocumentPaginator::class, $fake);
});

it('create a fake table row', function () {
    $fake = TableRow::fake();

    $this->assertInstanceOf(TableRow::class, $fake);
});
