<?php
namespace App\Service;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JwtService
{
    /**
     * @param string $token
     * @return array
     */
    public static function decodeToken(string $token): array
    {
        $config = config('app');
        $decoded = JWT::decode($token, new Key(base64_decode($config['key']), 'HS256'));
        return (array) $decoded;
    }

    /**
     * @param array $data
     * @return string
     */
    public static function encodeToken(array $data): string
    {
        $config = config('app');
        $token = JWT::encode($data, base64_decode($config['key']), 'HS256');
        return $token;
    }

    /**
     * check if token is valid
     */
    public static function isValidToken(string $token): bool
    {
        try {
            self::decodeToken($token);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}