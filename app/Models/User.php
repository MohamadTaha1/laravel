<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function dashboard()
    {
        $user = auth()->user()->load('cars.images');
        return view('dashboard', compact('user'));
    }

    // Inside User model
    public function buyRequests()
    {
        return $this->hasManyThrough(BuyRequest::class, Car::class);
    }

    // Assuming SellRequest is a separate model or logic
    public function rentRequests()
    {
        return $this->hasManyThrough(RentRequest::class, Car::class, 'user_id', 'car_id', 'id', 'id');
    }



    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Car::class);
    }


}
