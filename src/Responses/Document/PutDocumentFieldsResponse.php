<?php

namespace Klongchu\DocuWare\Responses\Document;

use Illuminate\Support\Collection;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Klongchu\DocuWare\Support\ParseValue;
use Saloon\Contracts\Response;

final class PutDocumentFieldsResponse
{
    public static function fromResponse(Response $response): Collection
    {
        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        $fields = $response->throw()->json('Field');

        return collect($fields)->mapWithKeys(function (array $field) {
            return [
                $field['FieldName'] => ParseValue::field($field),
            ];
        });
    }
}
