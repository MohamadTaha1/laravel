<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'car_id',
        'owner_id',
        'status',
    ];

    /**
     * Get the user (buyer) associated with the buy request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car associated with the buy request.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the owner of the car being requested.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
