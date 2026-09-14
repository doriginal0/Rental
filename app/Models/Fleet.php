<?php

namespace App\Models;

use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fleet extends Model
{
    protected $fillable = [
        'fleet_name',
        'category',
        'description',
    ];

   

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }


     protected static function booted()
    {
        static::addGlobalScope(new ClientScope);
    }
}
