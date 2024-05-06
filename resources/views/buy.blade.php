<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Available Cars For Sale
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('cars-for-sale') }}" class="mb-6">
            <div class="flex space-x-4 items-center mb-4">
                <div>
                    <input type="text" name="search" placeholder="Search by make or model..." class="px-4 py-2 border rounded-lg" value="{{ request('search') }}">
                </div>
                <!-- Add additional filters as needed -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Search</button>
                </div>
            </div>
        </form>

        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($carsForSale as $car)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="{{ $car->images->first()->image_path ?? 'https://media.ed.edmunds-media.com/toyota/corolla/2023/oem/2023_toyota_corolla_sedan_xse_fq_oem_1_815.jpg' }}" alt="Car">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $car->make }} {{ $car->model }}</h3>
                        <p class="text-gray-700">Year: {{ $car->year }}</p>
                        <p class="text-gray-700">Price: ${{ number_format($car->price, 2) }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <a href="{{ route('cars.show', $car->id) }}" class="text-sm bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No cars available for sale.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
