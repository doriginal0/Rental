<?php

namespace App\Models;
use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        
        
        'client_id',
        'car_id', 'customer_id', 'driver_id', 'pickup_datetime',
        'return_datetime', 'status', 'notes', 'daily_rate', 'total_cost', 'driver_daily_rate', 'method',
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'return_datetime' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getDurationInDaysAttribute(): int
    {
        return max(1, (int) ceil(
            $this->pickup_datetime->diffInHours($this->return_datetime) / 24
        ));
    }

     protected static function booted()
    {
        static::addGlobalScope(new ClientScope);
    }
}
