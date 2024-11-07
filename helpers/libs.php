<?php

/**
 * Checks if the function 'cacheKey_refreshToken' exists.
 * If it does not exist, it can be defined to avoid redeclaration errors.
 */
if(!function_exists('cacheKey_refreshToken')) {
    function cacheKey_refreshToken(string $emailUser): string {
        return md5($emailUser.'refresh_token');
    }
}