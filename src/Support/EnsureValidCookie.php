<?php

namespace Klongchu\DocuWare\Support;

use GuzzleHttp\Cookie\CookieJar;
use Klongchu\DocuWare\Events\DocuWareCookieCreatedLog;
use Klongchu\DocuWare\Events\DocuWareResponseLog;
use Klongchu\DocuWare\Exceptions\UnableToLogin;
use Klongchu\DocuWare\Exceptions\UnableToLoginNoCookies;
use Klongchu\DocuWare\Requests\Auth\PostLogonRequest;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidCookie
{
    /**
     * @throws \Throwable
     */
    public static function check(): void
    {
        if (Auth::check()) {
            return;
        }

        EnsureValidCredentials::check();

        event(new DocuWareCookieCreatedLog('Creating new authenticaion cookie for caching'));

        $cookieJar = new CookieJar();

        $request = new PostLogonRequest();

        $request->config()->add('cookies', $cookieJar);

        $response = $request->send();

        event(new DocuWareResponseLog($response));

        throw_if($response->status() === Response::HTTP_UNAUTHORIZED, UnableToLogin::create());
        throw_if($cookieJar->toArray() === [], UnableToLoginNoCookies::create());

        Auth::store($cookieJar);
    }
}
