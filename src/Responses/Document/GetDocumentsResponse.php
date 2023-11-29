<?php

namespace Klongchu\DocuWare\Responses\Document;

use Illuminate\Support\Collection;
use Klongchu\DocuWare\DTO\Document;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetDocumentsResponse
{
    public static function fromResponse(Response $response): Collection
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $items = $response->throw()->json('Items');

        return collect($items)->map(fn (array $item) => Document::fromJson($item));
    }
}
