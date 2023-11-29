<?php

namespace Klongchu\DocuWare\Support;

use Klongchu\DocuWare\Exceptions\UnableToFindPasswordCredential;
use Klongchu\DocuWare\Exceptions\UnableToFindUrlCredential;
use Klongchu\DocuWare\Exceptions\UnableToFindUserCredential;

class EnsureValidCredentials
{
    public static function check(): void
    {
        throw_if(
            empty(config('docuware.credentials.url')),
            UnableToFindUrlCredential::create(),
        );

        throw_if(
            empty(config('docuware.credentials.username')),
            UnableToFindUserCredential::create(),
        );

        throw_if(
            empty(config('docuware.credentials.password')),
            UnableToFindPasswordCredential::create(),
        );

    }
}
