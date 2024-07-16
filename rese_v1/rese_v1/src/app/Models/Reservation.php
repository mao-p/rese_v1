<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'reservation_date',
        'reservation_time',
        'party_size',
    ];

    public function user()
    {
        return $this->belongsTo(USer::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
