<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class PaymentMethod extends Model
{
    use HasUuid;

    protected $fillable = [
        'name',
        'account_number',
        'account_name',
        'qr_image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
