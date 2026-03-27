<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Traits\HasUuid;

class Transaction extends Model
{
    use HasUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'invoice_number',
        'package_id',
        'subtotal',
        'admin_fee',
        'total_amount',
        'status',
        'payment_proof',
        'confirmed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
        ];
    }

    /**
     * Relationship: User (The buyer)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Package (The product)
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
