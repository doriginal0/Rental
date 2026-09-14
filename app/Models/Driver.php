<?php

namespace App\Models;
use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    protected $fillable = [
        'client_id', 'name', 'phone', 'license_number', 'license_expiry', 'description', 'driver_daily_rate', 'image_url'];
    
    protected $casts = [
    'license_expiry' => 'date',   // add this
                ];

    public function client() {

    return $this->belongsTo(Client::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvilable(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
     public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

     protected static function booted()
    {
        static::addGlobalScope(new ClientScope);
    }

    
}

