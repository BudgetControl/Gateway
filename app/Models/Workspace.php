<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Workspace extends Authenticatable
{
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
    ];

}
