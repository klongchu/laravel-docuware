<?php

namespace Klongchu\DocuWare\Responses\SelectList;

use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetSelectListResponse
{
    public static function fromResponse(Response $response): mixed
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        return $response->throw()->json('Value');
    }
}
