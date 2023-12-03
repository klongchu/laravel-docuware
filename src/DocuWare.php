<?php

namespace Klongchu\DocuWare;

use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Requests\Auth\GetLogoffRequest;
use Klongchu\DocuWare\Support\Auth;
use Klongchu\DocuWare\Support\EnsureValidCookie;
use Klongchu\DocuWare\Support\EnsureValidCredentials;
use Klongchu\DocuWare\Support\EnsureValidResponse;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Illuminate\Support\Facades\Http;


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

    public function getDocumentImage(
        string $fileCabinetId,
        string $documentId,
        int $page,
    ): string {
        EnsureValidCookie::check();

        $url = sprintf(
            '%s/DocuWare/Platform/FileCabinets/%s/Rendering/%s/Image?page=%s&v=%s',
            config('docuware.credentials.url'),
            $fileCabinetId,
            $documentId,
            $page,
            md5($documentId.''.$page),
        );

        $response = Http::acceptJson()
            ->withCookies(Auth::cookies(), Auth::domain())
            ->get($url);

        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        return $response->throw()->body();
    }

    public function getDocumentThumbnail(
        string $fileCabinetId,
        int $documentId,
    ): string {
        EnsureValidCookie::check();

        $url = sprintf(
            '%s/DocuWare/Platform/FileCabinets/%s/Documents/%s/Thumbnail?v=0&annotations=False',
            config('docuware.credentials.url'),
            $fileCabinetId,
            $documentId,
        );

        $response = Http::acceptJson()
            ->withCookies(Auth::cookies(), Auth::domain())
            ->get($url);

        event(new DocuWareResponseLog($response));

        EnsureValidResponse::from($response);

        return $response->throw()->body();
    }
}
