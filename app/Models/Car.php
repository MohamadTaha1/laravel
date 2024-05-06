<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'make', 'model', 'year', 'vin', 'status', 'price', 'rent_price', 'description', 'is_for_sale', 'is_for_rent', 'is_for_bidding', 'start_price', 'bid_start_time', 'bid_end_time'
    ];

    protected $dates = [
        'bid_start_time',
        'bid_end_time'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function isBiddable()
    {
        return $this->is_for_bidding && now()->between($this->bid_start_time, $this->bid_end_time);
    }
}
