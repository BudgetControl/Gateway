<?php 
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Traits;

use Illuminate\Support\Facades\Cache;

trait GetDataInCache {

    protected function getEncryptionKeyFromCache(string $key): mixed
    {
        $key = md5($key . 'encrypt_key');
        return Cache::get($key);
    }
}