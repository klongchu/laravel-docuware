<?php

namespace Klongchu\DocuWare\Responses\Document\Thumbnail;

use Klongchu\DocuWare\DTO\DocumentThumbnail;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetDocumentDownloadThumbnailResponse
{
    public static function fromResponse(Response $response): DocumentThumbnail
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        return DocumentThumbnail::fromData([
            'mime' => $response->throw()->header('Content-Type'),
            'data' => $response->throw()->body(),
        ]);
    }
}
