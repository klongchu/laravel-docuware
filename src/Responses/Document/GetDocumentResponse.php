<?php

namespace Klongchu\DocuWare\Responses\Document;

use Klongchu\DocuWare\DTO\Document;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetDocumentResponse
{
    public static function fromResponse(Response $response): Document
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $data = $response->throw()->json();

        return Document::fromJson($data);
    }
}
