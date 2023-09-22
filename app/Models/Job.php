<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    public $fillable = [
        'payload',
        'attempts',
        'created_at'
    ];

    protected $casts = [
        'payload' => 'array'
    ];
}
