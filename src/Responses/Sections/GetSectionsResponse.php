<?php

namespace Klongchu\DocuWare\Responses\Sections;

use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Saloon\Contracts\Response;

final class GetSectionsResponse
{
    public static function fromResponse(Response $response): Collection|Enumerable
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        return $response->throw()->json('Sections');
    }
}
