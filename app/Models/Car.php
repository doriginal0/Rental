<?php

namespace App\Models;
use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'client_id', 'fleet_id',
        'make', 'model', 'year', 'license_plate', 'color',
        'transmission', 'seats', 'daily_rate', 'status',
        'image_url', 'description'
    ];


     public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }


    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->make} {$this->model} ({$this->year})";
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
