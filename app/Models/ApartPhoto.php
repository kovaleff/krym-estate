<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApartPhoto extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'apart_id',
        'image',
        'is_featured',
    ];

//    protected $casts = [
//        'image' => 'array',
//    ];

    public function apart(): BelongsTo
    {
        return $this->belongsTo(Apart::class);
    }

}
