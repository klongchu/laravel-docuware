<?php

namespace Klongchu\DocuWare;

use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Requests\Auth\GetLogoffRequest;
use Klongchu\DocuWare\Support\Auth;
use Klongchu\DocuWare\Support\EnsureValidCookie;
use Klongchu\DocuWare\Support\EnsureValidCredentials;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class DocuWare
{
    /**
     * @throws InvalidResponseClassException
     * @throws \Throwable
     * @throws \ReflectionException
     * @throws PendingRequestException
     */
    public function login(): void
    {
        EnsureValidCredentials::check();

        // Checks if already logged in, if not, logs in
        EnsureValidCookie::check();
    }

    /**
     * @throws InvalidResponseClassException
     * @throws \Throwable
     * @throws \ReflectionException
     * @throws PendingRequestException
     */
    public function logout(): void
    {
        // SoloRequest
        $request = new GetLogoffRequest();

        $response = $request->send();

        event(new DocuWareResponseLog($response));

        Auth::forget();

        $response->throw();
    }

    public function searchRequestBuilder(): DocuWareSearchRequestBuilder
    {
        return new DocuWareSearchRequestBuilder();
    }

    public function url(): DocuWareUrl
    {
        return new DocuWareUrl();
    }
}
