<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasUuid;

class Theme extends Model
{
    use HasUuid;
    protected $fillable = [
        'slug',
        'name',
        'description',
        'tag',
        'color',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
