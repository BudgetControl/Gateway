<?php
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Facade;

trait Cache {

    protected string $cacheKey;
    protected Repository $cacheManager;

    /**
     * Initialize the cache with the given key.
     *
     * @param string $key The key to initialize the cache with.
     * @return self Returns the instance of the class for method chaining.
     */
    public function initCache(string $key): self
    {
        $this->cacheKey = md5($key);
        $cahe = Facade::getFacadeApplication()->make('cache');
        $this->cacheManager = $cahe->store(config('cache.default'));

        return $this;
    }

    /**
     * Retrieve the cached data.
     *
     * @return mixed The cached data.
     */
    public function getCache(): mixed
    {
        return $this->cacheManager->get($this->cacheKey);
    }

    /**
     * Set the cache with the given data for a specified duration.
     *
     * @param mixed $data The data to be cached.
     * @param int $minutes The duration in minutes for which the data should be cached. Default is 60 minutes.
     * @return void
     */
    public function setCache(mixed $data, int $minutes = 60): void
    {
        $this->cacheManager->put($this->cacheKey, $data, $minutes);
    }

    /**
     * Clears the cache.
     *
     * This method is used to remove or invalidate cached data.
     *
     * @return void
     */
    public function forgetCache(): void
    {
        $this->cacheManager->forget($this->cacheKey);
    }

    /**
     * Check if the cache exists.
     *
     * @return bool Returns true if the cache exists, false otherwise.
     */
    public function hasCache(): bool
    {
        return $this->cacheManager->has($this->cacheKey);
    }

    /**
     * Caches the result of the given callback for a specified number of minutes.
     *
     * @param int $minutes The number of minutes to cache the result.
     * @param callable $callback The callback function whose result should be cached.
     * @return mixed The result of the callback function.
     */
    public function rememberCache(int $minutes, callable $callback): mixed
    {
        return $this->cacheManager->remember($this->cacheKey, $minutes, $callback);
    }

    /**
     * Caches the result of the given callback function indefinitely.
     *
     * @param callable $callback The callback function whose result should be cached.
     * @return mixed The result of the callback function.
     */
    public function rememberForeverCache(callable $callback): mixed
    {
        return $this->cacheManager->rememberForever($this->cacheKey, $callback);
    }

    /**
     * Generate and return the cache key as a string.
     *
     * @return string The generated cache key.
     */
    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }




}