<?php
declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use malirobot\AwsCognito\CognitoClient;
use malirobot\AwsCognito\Exception\TokenExpiryException;

class AuthCognitoService
{

    private readonly CognitoClient $cognitoClient;
    
    public function __construct()
    {

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
        
        $aws = new \Aws\Sdk($config);
        $cognitoClient = $aws->createCognitoIdentityProvider();
        
        $awsCognitoClient = new CognitoClient($cognitoClient);
        $awsCognitoClient->setAppClientId($config['app_client_id']);
        $awsCognitoClient->setAppClientSecret($config['app_client_secret']);
        $awsCognitoClient->setRegion($config['region']);
        $awsCognitoClient->setUserPoolId($config['user_pool_id']);
        $awsCognitoClient->setAppName(env('APP_NAME'));
        $awsCognitoClient->setAppRedirectUri($config['redirect_uri']);
        
        $this->cognitoClient = $awsCognitoClient;
        
    }

    /**
     * Validates the given authentication token.
     *
     * @param string $token The authentication token to be validated.
     * @return string|bool Returns true if the token is valid, false otherwise.
     */
    public function validateAuthToken(string $token): string|bool
    {
        try {
            $username = $this->cognitoClient->verifyAccessToken($token);
        } catch( TokenExpiryException $e) {

            $cacheKey = cacheKey_refreshToken($username);
            $refreshToken = Cache::get($cacheKey);
            if (!$refreshToken) {
                Log::warning('Refresh token not found in cache');
                return false;
            }
            $newTokens = $this->cognitoClient->refreshAuthentication($username, $refreshToken);
            if (!$newTokens) {
                Log::error('Failed to refresh tokens');
                return false;
            }

            $token = $newTokens['AccessToken'];
            Cache::put($cacheKey, $token, 60 * 24 * 30);

        } catch( \Exception $e) {
            Log::warning($e->getMessage());
            return false;
        }

        return $token;
    }
}