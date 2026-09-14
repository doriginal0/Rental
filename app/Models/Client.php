<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Client extends Authenticatable

{
    use Notifiable;
    protected $fillable = [
    'name',
    'email',
    'password',
    'company_name',
    'phone',
    'is_admin'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
        { return ['email_verified_at' => 'datetime', 'password' => 'hashed', 'is_admin' => 'boolean']; }

    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    public function cars()  { return $this->hasMany(Car::class); }
    public function customers() { return $this->hasMany(Customer::class);}
    public function bookings() { return $this->hasMany(Booking::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function maintenances() { return $this->hasMany(Maintenance::class);} 
}



