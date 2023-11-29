<?php

namespace Klongchu\DocuWare\Responses\Fields;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Klongchu\DocuWare\DTO\Field;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Contracts\Response;

final class GetFieldsResponse
{
    public static function fromResponse(Response $response): Collection|Enumerable
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $fields = $response->throw()->json('Fields');

        return collect($fields)->map(fn (array $field) => Field::fromJson($field));
    }
}
