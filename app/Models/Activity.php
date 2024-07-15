<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name', 'description', 'location', 'price', 'available_slots', 'start_time', 'created_at', 'updated_at'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}