<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
      'title',
      'regions',
      'content',
      'founded',
      'phone',
      'address',
      'siteurl',
      'image',
      'developer_link'
    ];

    public function aparts():HasMany {
        return $this->hasMany(Apart::class);
    }
}
