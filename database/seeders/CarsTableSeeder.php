<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cars')->insert([
            [
                'user_id' => 1,
                'make' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2020,
                'vin' => '1NXBR32E54Z219290',
                'status' => 'available',
                'price' => 18000,
                'description' => 'A reliable car for daily use.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'make' => 'Honda',
                'model' => 'Civic',
                'year' => 2019,
                'vin' => '2HGFC2F59KH573662',
                'status' => 'sold',
                'price' => 15000,
                'description' => 'Compact car with excellent fuel efficiency.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'make' => 'Ford',
                'model' => 'Mustang',
                'year' => 2018,
                'vin' => '1FA6P8TH4J5103070',
                'status' => 'available',
                'price' => 25000,
                'description' => 'A classic American muscle car.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 4,
                'make' => 'Chevrolet',
                'model' => 'Camaro',
                'year' => 2017,
                'vin' => '1G1FB1RS7H0106714',
                'status' => 'rented',
                'price' => 23000,
                'description' => 'Stylish and powerful sports car.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,
                'make' => 'Tesla',
                'model' => 'Model S',
                'year' => 2020,
                'vin' => '5YJSA1E26LF320221',
                'status' => 'available',
                'price' => 70000,
                'description' => 'Luxury electric vehicle with autopilot.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'make' => 'BMW',
                'model' => '3 Series',
                'year' => 2018,
                'vin' => 'WBA8A9C58JK678945',
                'status' => 'available',
                'price' => 27000,
                'description' => 'Sporty sedan with excellent handling.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'make' => 'Audi',
                'model' => 'A4',
                'year' => 2019,
                'vin' => 'WAUDNAF49KN017123',
                'status' => 'sold',
                'price' => 29000,
                'description' => 'Compact luxury car with a comfortable interior.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'make' => 'Mercedes-Benz',
                'model' => 'C-Class',
                'year' => 2020,
                'vin' => 'WDDWF8DB1LR537666',
                'status' => 'available',
                'price' => 35000,
                'description' => 'High-end sedan with advanced technology.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 4,
                'make' => 'Nissan',
                'model' => '370Z',
                'year' => 2020,
                'vin' => 'JN1AZ4EH6LM820111',
                'status' => 'rented',
                'price' => 30000,
                'description' => 'Iconic sports car with exceptional performance.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,
                'make' => 'Subaru',
                'model' => 'WRX',
                'year' => 2019,
                'vin' => 'JF1VA1A69K9823456',
                'status' => 'available',
                'price' => 25000,
                'description' => 'All-wheel-drive sports sedan known for its rally heritage.',
                'is_for_sale' => 1, // Added
                'is_for_rent' => 1, // Added
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
