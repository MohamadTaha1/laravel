<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\CarImage; // Import the CarImage model here
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; 
use App\Models\Transaction;


use GuzzleHttp\Client;



class CarController extends Controller
{
    // Display a listing of the cars.
    public function index()
    {
        $cars = Auth::user()->cars;
        return view('cars.index', compact('cars'));
    }

    // Show the form for creating a new car.
    public function create()
    {
        return view('cars.create');
    }



    public function store(Request $request)
{
    $validated = $request->validate([
        'make' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|integer',
        'vin' => 'required|string|unique:cars,vin',
        'status' => 'required|string',
        'price' => 'required|numeric',
        'rent_price' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $validated['user_id'] = Auth::id();
    $validated['is_for_sale'] = 1;
    $validated['is_for_rent'] = 1;

    // Create the car
    $car = Car::create($validated);

    // Check if an image is uploaded
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();  
        $request->image->storeAs('public/cars', $imageName);
        $imagePath = Storage::url('cars/'.$imageName);

        // Save the image path in car_images table
        CarImage::create([
            'car_id' => $car->id,
            'image_path' => $imagePath
        ]);
    }

    return redirect()->route('dashboard')->with('success', 'Car added successfully.');
}

    



    // Show the form for editing the specified car.
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Update the specified car in storage.
    public function update(Request $request, Car $car)
    {
        if (Auth::id() !== $car->user_id) {
            abort(403); // Or use authorization policies
        }
    
        $data = $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'vin' => 'required|string|unique:cars,vin,' . $car->id,
            'status' => 'required|string',
            'price' => 'required|numeric',
            'rent_price' => 'required|numeric', 
            'description' => 'required|string',
        ]);
    
        $car->update($data);
    
        return redirect()->route('dashboard')->with('success', 'Car updated successfully.');
    }
    


    // Remove the specified car from storage.
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('dashboard')->with('success', 'Car deleted successfully.');
    }

    public function sale(Car $car)
{
    if (Auth::id() !== $car->user_id) {
        abort(403);
    }

    $car->update(['is_for_sale' => !$car->is_for_sale]);
    return back()->with('success', $car->is_for_sale ? 'Car marked for sale.' : 'Car removed from sale.');
}

public function rent(Car $car)
{
    if (Auth::id() !== $car->user_id) {
        abort(403);
    }

    $car->update(['is_for_rent' => !$car->is_for_rent]);
    return back()->with('success', $car->is_for_rent ? 'Car marked for rent.' : 'Car removed from rent.');
}

    

public function show(Car $car)
{
    return view('cars.show', compact('car'));
}

protected function fetchCars($make, $model, $year, $fuel_type, $limit) {
    $client = new Client();
    $response = $client->request('GET', 'https://cars-by-api-ninjas.p.rapidapi.com/v1/cars', [
        'headers' => [
            'X-RapidAPI-Key' => 'abcd1b79ebmsh20750cef3fffbc9p1cba32jsn5e8898a38eed',
            'X-RapidAPI-Host' => 'cars-by-api-ninjas.p.rapidapi.com',
        ],
        'query' => [
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'fuel_type' => $fuel_type,
            'limit' => $limit,
        ],
    ]);

    if ($response->getStatusCode() == 200) {
        $body = $response->getBody();
        $result = json_decode($body);
        return $result ?? [];
    }

    return [];
}

    public function fetchFromApi(Request $request) {

    $make = $request->query('make', '');
    $model = $request->query('model', '');
    $year = $request->query('year', '2022');
    $fuel_type = $request->query('fuel_type', 'Gas');
    $limit = $request->query('limit', 10);

    
    $cars = $this->fetchCars($make, $model, $year, $fuel_type, $limit);

    
        foreach ($cars as &$car) {
            $car->rental_rate = $this->calculateCarRent($car->city_mpg, $car->year);
            $car->image_url = $this->generateCarImageUrl($car->make, $car->model, $car->year);
        }
        unset($car);
    
        return view('welcome', compact('cars'));
    }
    
    function calculateCarRent($cityMpg, $year) {
        $basePricePerDay = 50;
        $mileageFactor = 0.1;
        $ageFactor = 0.05;
    
        $mileageRate = $cityMpg * $mileageFactor;
        $ageRate = (date('Y') - $year) * $ageFactor;
    
        $rentalRatePerDay = $basePricePerDay + $mileageRate + $ageRate;
    
        return round($rentalRatePerDay);
    }

    function generateCarImageUrl($make, $model, $year, $angle = '29') {
        $url = 'https://cdn.imagin.studio/getimage';
        $params = [
            'customer' => 'hrjavascript-mastery',
            'make' => $make,
            'modelFamily' => explode(' ', $model)[0],
            'zoomType' => 'fullscreen',
            'modelYear' => $year,
            'angle' => $angle,
        ];
    
        return $url . '?' . http_build_query($params);
    }
    
    


}
