
@php
$manufacturers = [
    'Acura',
  'Alfa Romeo',
  'Aston Martin',
  'Audi',
  'Bentley',
  'BMW',
  'Buick',
  'Cadillac',
  'Chevrolet',
  'Chrysler',
  'Citroen',
  'Dodge',
  'Ferrari',
  'Fiat',
  'Ford',
  'GMC',
  'Honda',
  'Hyundai',
  'Infiniti',
  'Jaguar',
  'Jeep',
  'Kia',
  'Lamborghini',
  'Land Rover',
  'Lexus',
  'Lincoln',
  'Maserati',
  'Mazda',
  'McLaren',
  'Mercedes-Benz',
  'MINI',
  'Mitsubishi',
  'Nissan',
  'Porsche',
  'Ram',
  'Rolls- Royce',
  'Subaru',
  'Tesla',
  'Toyota',
  'Volkswagen',
  'Volvo'
];

$yearsOfProduction = [
  '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023',
];

$fuels = [
  'Gas', 'Electricity',
];
@endphp
<div class="max-w-7xl mx-auto px-8 py-8 my-8 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg shadow-xl">
    <form action="{{ route('cars.api-index') }}" method="GET" class="flex flex-col md:flex-row gap-4 justify-between items-center">
        <select name="make" class="w-full md:w-1/4 border border-blue-300 rounded-full text-blue-700 py-2 pl-4 pr-8 bg-white shadow-lg focus:ring focus:ring-blue-500 transition-all">
            <option value="">Select Manufacturer</option>
            @foreach ($manufacturers as $manufacturer)
                <option value="{{ $manufacturer }}" @if(request('make') == $manufacturer) selected @endif>{{ $manufacturer }}</option>
            @endforeach
        </select>

        <input type="text" name="model" placeholder="Search by model" class="w-full md:w-1/4 border border-blue-300 rounded-full py-2 px-4 bg-white shadow-lg focus:ring focus:ring-blue-500 transition-all" value="{{ request('model') }}">

        <select name="year" class="w-full md:w-1/4 border border-blue-300 rounded-full text-blue-700 py-2 pl-4 pr-8 bg-white shadow-lg focus:ring focus:ring-blue-500 transition-all">
            <option value="">All Years</option>
            @foreach ($yearsOfProduction as $year)
                <option value="{{ $year }}" @if(request('year') == $year) selected @endif>{{ $year }}</option>
            @endforeach
        </select>

        <select name="fuel_type" class="w-full md:w-1/4 border border-blue-300 rounded-full text-blue-700 py-2 pl-4 pr-8 bg-white shadow-lg focus:ring focus:ring-blue-500 transition-all">
            <option value="">All Fuel Types</option>
            <option value="Gas" @if(request('fuel_type') == 'Gas') selected @endif>Gas</option>
            <option value="Electricity" @if(request('fuel_type') == 'Electricity') selected @endif>Electricity</option>
        </select>

        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full shadow-md hover:shadow-lg transition-all duration-200 ease-in-out">Search</button>
    </form>
</div>
<div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($cars as $car)
        <div class="bg-white rounded-xl py-12 overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:-translate-y-1">
            <img src="{{ $car->image_url }}" alt="Image of {{ $car->make }} {{ $car->model }}" class="w-full h-54 object-cover rounded-t-xl">
            <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-xl mx-4">
            <h3 class="text-2xl font-bold text-blue-900 mb-4">{{ $car->make }} {{ $car->model }}</h3>
            <div class="grid grid-cols-2 gap-4">
                <p class="text-md text-blue-800">Year: <span class="text-gray-700 font-semibold">{{ $car->year }}</span></p>
                <p class="text-md text-blue-800">Fuel Type: <span class="text-gray-700 font-semibold">{{ ucfirst($car->fuel_type) }}</span></p>
                <p class="text-md text-blue-800">Mileage: <span class="text-gray-700 font-semibold">{{ $car->city_mpg }} city MPG</span></p>
                <p class="text-lg font-bold text-blue-800">Rent: <span class="text-gray-700">$ {{ $car->rental_rate }}/day</span></p>
            </div>
            <div class="mt-4">
                <h4 class="text-lg font-semibold text-blue-900 mb-2">Additional Details:</h4>
                <div class="bg-white p-4 rounded-lg shadow">
                    <ul class="space-y-2">
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Class:</span> {{ $car->class }}
                        </li>
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Combination MPG:</span> {{ $car->combination_mpg }}
                        </li>
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Cylinders:</span> {{ $car->cylinders }}
                        </li>
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Displacement:</span> {{ $car->displacement }}
                        </li>
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Drive:</span> {{ ucfirst($car->drive) }}
                        </li>
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Highway MPG:</span> {{ $car->highway_mpg }}
                        </li>
                        <li class="text-sm font-medium text-blue-800">
                            <span class="font-bold">Transmission:</span> {{ $car->transmission == 'a' ? 'Automatic' : 'Manual' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        </div>
    @empty
        <div class="col-span-3 text-center py-8">
            <p class="text-lg text-blue-800">No cars found. Try adjusting your search criteria.</p>
        </div>
    @endforelse
</div>
