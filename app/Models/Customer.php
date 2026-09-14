<?php

namespace App\Models;

use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'client_id',
        'first_name', 'last_name', 'email', 'phone',
        'address', 'license_number', 'license_expiry'
    ];

    protected $casts = [
        'license_expiry' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

     protected static function booted()
    {
        static::addGlobalScope(new ClientScope);
    }
}
