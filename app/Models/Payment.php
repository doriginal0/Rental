<?php

namespace App\Models;

use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
   
    protected $fillable = [
        'client_id', 'booking_id', 'amount', 'method', 'status', 'reference', 'paid_at', 'type', 'description'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
     protected static function booted()
    {
        static::addGlobalScope(new ClientScope);
    }
    public function isIncome(): bool
{
    return $this->type === 'income';
}

public function isExpense(): bool
{
    return $this->type === 'expense';
}
}
