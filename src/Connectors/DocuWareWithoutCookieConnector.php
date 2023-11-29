<?php

namespace Klongchu\DocuWare\Connectors;

use Klongchu\DocuWare\Support\Auth;
use Klongchu\DocuWare\Support\EnsureValidCookie;
use Klongchu\DocuWare\Support\EnsureValidCredentials;
use GuzzleHttp\Cookie\CookieJar;
use Saloon\Http\Connector;

class DocuWareWithoutCookieConnector extends Connector
{
    public CookieJar $cookieJar;

    public function __construct()
    {
        EnsureValidCredentials::check();
        EnsureValidCookie::check();

        $this->cookieJar = Auth::cookieJar() ?? throw new \Exception('No cookie jar found');
    }

    /**
     * @throws \Exception
     */
    public function resolveBaseUrl(): string
    {
        return config('docuware.credentials.url').'/DocuWare/Platform';
    }

    public function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }

    public function defaultConfig(): array
    {
        return [
            'timeout' => config('docuware.timeout'),
            'cookies' => $this->cookieJar,
        ];
    }

    public function getCoookieJar(): CookieJar
    {
        return $this->cookieJar;
    }
}
