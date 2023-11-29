<?php

namespace Klongchu\DocuWare\Responses\Organization;

use Klongchu\DocuWare\DTO\Organization;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetOrganizationResponse
{
    public static function fromResponse(Response $response): Organization
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $organization = $response->throw()->json();

        return Organization::fromJson($organization);
    }
}
