<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    
    /**
     * {@inheritdoc}
     */
    protected $table = 'activity_logs';

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'body' => 'json',
    ];

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'method',
        'url',
        'body',
        'user_id',
    ];
}
