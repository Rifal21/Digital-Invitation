<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasUuid;

class Package extends Model
{
    use HasUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'features',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
        ];
    }
}
