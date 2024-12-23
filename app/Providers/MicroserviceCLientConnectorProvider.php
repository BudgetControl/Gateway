<?php

namespace App\Providers;

use App\Service\AuthCognitoService;
use Budgetcontrol\Connector\Entities\MsDomains;
use Budgetcontrol\Connector\Factory\MicroserviceCLient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class MicroserviceCLientConnectorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('MicroserviceCLient', function ($app) {
            $logger = Log::channel('MicroserviceCLient');

            $domains = new MsDomains(
                budget: config('routes.budget'),
                workspace: config('routes.workspace'),
                stats: config('routes.stats'),
                wallet: config('routes.wallet'),
                entry: config('routes.entry'),
                saving: config('routes.savings'),
            );
            
            return new MicroserviceCLient($domains, $logger);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
