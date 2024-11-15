<?php

/**
 * Checks if the function 'cacheKey_refreshToken' exists.
 * If it does not exist, it can be defined to avoid redeclaration errors.
 */
if(!function_exists('cacheKey_refreshToken')) {
    function cacheKey_refreshToken(string $username): string {
        return md5($username.'refresh_token');
    }
}