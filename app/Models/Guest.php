<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Guest extends Model
{
    use HasUuid;

    protected $fillable = [
        'invitation_id',
        'name',
        'slug',
        'phone',
        'group',
        'rsvp_status',
        'is_attended',
        'qr_code',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
