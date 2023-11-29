<?php

namespace Klongchu\DocuWare\Responses\Dialogs;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Klongchu\DocuWare\DTO\Dialog;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetDialogsResponse
{
    public static function fromResponse(Response $response): Collection|Enumerable
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $dialogs = $response->throw()->json('Dialog');

        return collect($dialogs)->map(fn (array $dialog) => Dialog::fromJson($dialog));
    }
}
