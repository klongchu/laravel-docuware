<?php

namespace Klongchu\DocuWare\Facades;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Klongchu\DocuWare\DocuWareSearchRequestBuilder;
use Klongchu\DocuWare\DocuWareUrl;
use Klongchu\DocuWare\DTO\Dialog;
use Klongchu\DocuWare\DTO\Document;
use Klongchu\DocuWare\DTO\DocumentThumbnail;
use Klongchu\DocuWare\DTO\Field;
use Klongchu\DocuWare\DTO\FileCabinet;
use Klongchu\DocuWare\DTO\Organization;
use Klongchu\DocuWare\DTO\OrganizationIndex;

/**
 * @see \Klongchu\DocuWare\DocuWare
 *
 * @method static self cookie()
 * @method static string login()
 * @method static void logout()
 * @method static Organization getOrganization(string $organizationId)
 * @method static Collection|OrganizationIndex[] getOrganizations()
 * @method static Collection|FileCabinet[] getFileCabinets()
 * @method static Collection|Field[] getFields(string $fileCabinetId)
 * @method static Collection|Dialog[] getDialogs(string $fileCabinetId)
 * @method static array getSelectList(string $fileCabinetId, string $dialogId, string $fieldName)
 * @method static Document getDocument(string $fileCabinetId, int $documentId)
 * @method static string getDocumentPreview(string $fileCabinetId, int $documentId)
 * @method static string downloadDocument(string $fileCabinetId, int $documentId)
 * @method static string downloadDocuments(string $fileCabinetId, array $documentIds)
 * @method DocumentThumbnail downloadDocumentThumbnail(string $fileCabinetId, int $documentId, int $section, int $page = 0)
 * @method static null|int|float|Carbon|string updateDocumentValue(string $fileCabinetId, int $documentId, string $fieldName, string $newValue, bool $forceUpdate = false)
 * @method static null|int|float|Carbon|string updateDocumentValues(string $fileCabinetId, int $documentId, array $values, bool $forceUpdate = false)
 * @method static Document uploadDocument(string $fileCabinetId, string $fileContent, string $fileName, ?Collection $indexes = null)
 * @method static int documentCount(string $fileCabinetId, string $dialogId)
 * @method static void deleteDocument(string $fileCabinetId, int $documentId)
 * @method static DocuWareSearchRequestBuilder search()
 * @method static DocuWareUrl url()
 */
class DocuWare extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Klongchu\DocuWare\DocuWare::class;
    }
}
