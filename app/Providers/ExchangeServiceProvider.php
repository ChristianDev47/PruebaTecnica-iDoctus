<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateRepositoryInterface;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateServiceInterface;
use App\Modules\Exchange\Infrastructure\Repositories\ExchangeRateRepository;
use App\Modules\Exchange\Application\Services\ExchangeRateService;
use App\Modules\Exchange\Infrastructure\Adapters\ExchangeRateAPIAdapter;
use App\Modules\Exchange\Infrastructure\Adapters\FallbackStorageAdapter;
use App\Modules\Exchange\Infrastructure\Cache\ExchangeRateCache;
use App\Modules\Exchange\Infrastructure\Monitoring\ExchangeMonitoring;

class ExchangeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExchangeRateCache::class);
        $this->app->singleton(ExchangeMonitoring::class);
        $this->app->singleton(ExchangeRateAPIAdapter::class);

        $this->app->singleton(FallbackStorageAdapter::class, function ($app) {
            return new FallbackStorageAdapter($app->make(ExchangeRateCache::class));
        });

        $this->app->singleton(ExchangeRateRepositoryInterface::class, function ($app) {
            return new ExchangeRateRepository(
                $app->make(ExchangeRateAPIAdapter::class),
                $app->make(FallbackStorageAdapter::class),
                $app->make(ExchangeRateCache::class),
                $app->make(ExchangeMonitoring::class)
            );
        });

        $this->app->singleton(ExchangeRateServiceInterface::class, function ($app) {
            return new ExchangeRateService(
                $app->make(ExchangeRateRepositoryInterface::class)
            );
        });
    }

}
