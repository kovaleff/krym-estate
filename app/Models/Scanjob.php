<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scanjob extends Model
{
    use HasFactory;
    public $fillable = [
        'done',
        'percents',
        'type',
    ];
}
