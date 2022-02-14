<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{

    protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];
}
