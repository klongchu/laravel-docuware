<?php

namespace Klongchu\DocuWare\Support;

use Klongchu\DocuWare\Exceptions\UnableToFindPassphrase;

class EnsureValidPassphrase
{
    public static function check(): void
    {
        throw_if(
            empty(config('docuware.passphrase')),
            UnableToFindPassphrase::create(),
        );
    }
}
