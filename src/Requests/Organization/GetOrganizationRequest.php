<?php

namespace Klongchu\DocuWare\Requests\Organization;

use Illuminate\Support\Facades\Cache;
use Klongchu\DocuWare\Responses\Organization\GetOrganizationResponse;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetOrganizationRequest extends Request implements Cacheable
{
    use HasCaching;

    protected Method $method = Method::GET;

    public function __construct(
        public string $organizationId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/Organizations/'.$this->organizationId;
    }

    public function resolveCacheDriver(): LaravelCacheDriver
    {
        return new LaravelCacheDriver(Cache::store(config('docuware.configurations.cache.driver')));
    }

    public function cacheExpiryInSeconds(): int
    {
        return config('docuware.configurations.cache.lifetime_in_seconds', 3600);
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return GetOrganizationResponse::fromResponse($response);
    }
}
