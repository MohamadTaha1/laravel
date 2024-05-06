<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarImagesTableSeeder extends Seeder
{
    public function run()
    {
        $carImages = [
            ['car_id' => 1, 'image_path' => 'https://example.com/path/to/your/image1.jpg'],
            ['car_id' => 2, 'image_path' => 'https://example.com/path/to/your/image2.jpg'],
            ['car_id' => 3, 'image_path' => 'https://example.com/path/to/your/image3.jpg'],
            ['car_id' => 1, 'image_path' => 'https://example.com/path/to/your/image4.jpg'],
            ['car_id' => 2, 'image_path' => 'https://example.com/path/to/your/image5.jpg'],
            ['car_id' => 3, 'image_path' => 'https://example.com/path/to/your/image6.jpg'],
            ['car_id' => 4, 'image_path' => 'https://example.com/path/to/your/image7.jpg'],
            ['car_id' => 5, 'image_path' => 'https://example.com/path/to/your/image8.jpg'],
            ['car_id' => 4, 'image_path' => 'https://example.com/path/to/your/image9.jpg'],
            ['car_id' => 5, 'image_path' => 'https://example.com/path/to/your/image10.jpg'],
            // Add more images as needed
        ];

        foreach ($carImages as $image) {
            DB::table('car_images')->insert([
                'car_id' => $image['car_id'],
                'image_path' => $image['image_path'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
