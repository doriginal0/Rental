<?php

namespace App\Models;

use App\Models\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    protected $fillable = [
        'client_id',
        'car_id', 'scheduled_date', 'completed_date',
        'type', 'description', 'cost', 'status'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
     protected static function booted()
    {
        static::addGlobalScope(new ClientScope);
    }
}
