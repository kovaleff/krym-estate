<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apart extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'developer_id',
        'title',
        'parse_link',
        'link',
        'city',
        'phone',
        'address',
        'content',
        'attr',

    ];

    protected $casts = [
        'attr' => 'array'
    ];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function images():HasMany{
        return $this->hasMany(ApartPhoto::class);
    }
}
