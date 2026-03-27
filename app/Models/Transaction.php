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
        'payment_method_id',
        'subtotal',
        'admin_fee',
        'total_amount',
        'status',
        'payment_proof',
        'payment_url',
        'response_payload',
        'payment_method',
        'confirmed_at',
        'paid_at',
    ];

    /**
     * Map database table columns to specialized PHP types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
            'paid_at' => 'datetime',
            'response_payload' => 'array',
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

    /**
     * Relationship: PaymentMethod (The destination bank)
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
