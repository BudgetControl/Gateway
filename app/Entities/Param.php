<?php 
declare(strict_types=1);

namespace App\Entities;

use Closure;

Class Param {

    public readonly string $name;
    public readonly string|array $value;
    public readonly ?Closure $closure;

    public function __construct(string $name, string|array $value, ?Closure $closure = null) {
        $this->name = $name;
        $this->value = $value;
        $this->closure = $closure;
    }

}