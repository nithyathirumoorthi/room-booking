<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name','type','price','is_available'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function getAvailabilityStatusAttribute()
    {
        return $this->is_available ? 'Available' : 'Unavailable';
    }
}
