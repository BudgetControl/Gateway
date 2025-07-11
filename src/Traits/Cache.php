<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Traits;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache as Caching;

trait Cache {

    protected string $cacheKey = '';
    protected array $cacheTags = ['default'];

    /**
     * Initialize the cache with the given key.
     *
     * @param string $key The key to initialize the cache with.
     * @return self Returns the instance of the class for method chaining.
     */
    public function initCache(string $key, array $tags = []): self
    {
        $this->cacheKey = md5($key);
        $this->cacheTags = $tags;

        if(env('CACHE_DRIVER', null) === null) {
            throw new \Exception('Cache driver is not set in the environment configuration.');
        }

        return $this;
    }

    /**
     * Retrieve the cached data.
     *
     * @return mixed The cached data.
     */
    public function getCache(): mixed
    {
        return Caching::tags($this->cacheTags)->get($this->cacheKey);
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
        Caching::tags($this->cacheTags)->put($this->cacheKey, $data, $minutes * 60);
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
        Caching::tags($this->cacheTags)->forget($this->cacheKey);
    }

    /**
     * Check if the cache exists.
     *
     * @return bool Returns true if the cache exists, false otherwise.
     */
    public function hasCache(): bool
    {
        return Caching::tags($this->cacheTags)->has($this->cacheKey);
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
        return Caching::tags($this->cacheTags)->remember($this->cacheKey, $minutes, $callback);
    }

    /**
     * Caches the result of the given callback function indefinitely.
     *
     * @param callable $callback The callback function whose result should be cached.
     * @return mixed The result of the callback function.
     */
    public function rememberForeverCache(callable $callback): mixed
    {
        return Caching::tags($this->cacheTags)->rememberForever($this->cacheKey, $callback);
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

    /**
     * Deletes the cache.
     * 
     * This method is responsible for clearing or removing cached data.
     * 
     * @return void
     */
    public function deleteCache(): void
    {
        Caching::tags($this->cacheTags)->delete($this->cacheKey);
    }

     /**
     * Clears the cache.
     * 
     * This method is responsible for removing all cached data.
     * 
     * @return void
     */
    public function clearCache(): void
    {
        Caching::tags($this->cacheTags)->flush();
    }

    public function destroyCache(): void
    {
        Caching::flush();
    }

    /**
     * Sets the cache tags for the current operation.
     *
     * @param array $tags The tags to be associated with the cached item
     * @return self Returns the current instance for method chaining
     */
    public function cacheTags(array $tags): self
    {
        $this->cacheTags = $tags;
        return $this;
    }




}
