<?php
declare(strict_types=1);

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|bool validateAuthToken(string $token, string $subId)
 * @method static array decodeAccessToken(string $token)
 * 
 * @see \App\Service\AuthCognitoService
 */
final class AwsCognito extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'awsCognito';
    }
}