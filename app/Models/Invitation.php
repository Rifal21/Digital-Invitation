<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'id',
        'slug',
        'title',
        'groom_name',
        'bride_name',
        'event_date',
        'event_location',
        'message',
        'theme_color',
        'theme',
        'background_image',
        'hero_image',
        'data'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'event_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvitationMessage::class);
    }
}
