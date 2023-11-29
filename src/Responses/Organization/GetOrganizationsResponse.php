<?php

namespace Klongchu\DocuWare\Responses\Organization;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Klongchu\DocuWare\DTO\OrganizationIndex;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetOrganizationsResponse
{
    public static function fromResponse(Response $response): Collection|Enumerable
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $organizations = $response->throw()->json('Organization');

        return collect($organizations)->map(fn (array $cabinet) => OrganizationIndex::fromJson($cabinet));
    }
}
