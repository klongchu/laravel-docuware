<?php

namespace Klongchu\DocuWare\Responses\FileCabinets;

use Klongchu\DocuWare\DTO\FileCabinet;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Saloon\Contracts\Response;

final class GetFileCabinetsResponse
{
    public static function fromResponse(Response $response): Collection|Enumerable
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $cabinets = $response->throw()->json('FileCabinet');

        return collect($cabinets)->map(fn (array $cabinet) => FileCabinet::fromJson($cabinet));
    }
}
