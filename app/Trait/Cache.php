<?php
namespace App\Trait;

use Illuminate\Support\Facades\Cache as FacadesCache;

trait Cache {

    public function getCache($key): mixed 
    {
        // Retrieve data from cache using the provided key
        if (FacadesCache::has($key)) {
            return FacadesCache::get($key);
        }
        return null;
    }

    public function setCache($key, $value, int|bool|null $expiration = null): void
    {
        // Store data in cache with the provided key and optional expiration time
        if ($expiration === false) {
            FacadesCache::forever($key, $value);
        } else {
            FacadesCache::put($key, $value, $expiration);
        }
    }

    public function deleteCache($key): void
    {
        // Remove data from cache using the provided key
        FacadesCache::forget($key);
    }

    public function isInCache($key): bool
    {
        // Check if data exists in cache using the provided key
        return FacadesCache::has($key);
    }   

}