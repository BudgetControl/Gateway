<?php

namespace App\Providers;

use App\Service\AuthCognitoService;
use Illuminate\Support\ServiceProvider;

class AwsClientProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('awsCognito', function ($app) {
            $config = [
                'credentials' => [
                    'key' => config('aws.credentials.key'),
                    'secret' => config('aws.credentials.secret'),
                ],
                'region' => config('aws.region'),
                'version' => config('aws.version'),

                'app_client_id' => config('aws.cognito.app_client_id'),
                'app_client_secret' => config('aws.cognito.app_client_secret'),
                'user_pool_id' => config('aws.cognito.user_pool_id'),
                'redirect_uri' => config('aws.cognito.redirect_uri'),
            ];

            return new AuthCognitoService($config);
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
