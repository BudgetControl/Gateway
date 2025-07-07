<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Service;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use malirobot\AwsCognito\CognitoClient;
use malirobot\AwsCognito\Exception\TokenExpiryException;

class AuthCognitoService
{

    private readonly CognitoClient $cognitoClient;
    
    public function __construct(CognitoClient $cognito)
    {
        $this->cognitoClient = $cognito;
    }

    /**
     * Validates the given authentication token.
     *
     * @param string $token The authentication token to be validated.
     * @param string $subId The sub id of the user.
     * @return string|bool Returns true if the token is valid, false otherwise.
     */
    public function validateAuthToken(string $token, string $subId): string|bool
    {
        $cacheKey = cacheKey_refreshToken($subId);
        $refreshToken = Cache::get($cacheKey);
        Log::debug('Current refresh token: ' . $refreshToken);

        try {
            Log::debug('Validating token ' . $token);
            $this->cognitoClient->verifyAccessToken($token);
        } catch( TokenExpiryException $e) {

            Log::debug("Getting user name ". $subId);
            $cacheKey = cacheKey_refreshToken($subId);
            $refreshToken = Cache::get($cacheKey);
            if (!$refreshToken) {
                Log::warning('Refresh token not found in cache');
                return false;
            }

            Log::debug('Refresh token with [' . $subId . '] ' . $refreshToken);  
            $newTokens = $this->cognitoClient->refreshAuthentication($subId, $refreshToken);
            if (!$newTokens) {
                Log::error('Failed to refresh tokens');
                return false;
            }

            Log::debug('New tokens: ' . $newTokens['AccessToken']);
            $token = $newTokens['AccessToken'];

        } catch( \Exception $e) {
            Log::warning($e->getMessage());
            return false;
        }

        return $token;
    }

    /**
     * Decodes the given access token.
     *
     * @param string $token The access token to decode.
     * @return array The decoded token data.
     */
    public function decodeAccessToken(string $token): array
    {
        return $this->cognitoClient->decodeAccessToken($token);
    }
}
