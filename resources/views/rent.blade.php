{{-- resources/views/rent.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cars Available for Rent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form method="GET" action="{{ route('cars-for-rent') }}" class="flex items-center space-x-2">
                    <input type="text" name="search" placeholder="Search cars..." class="flex-1 border rounded py-2 px-4" value="{{ request('search') }}">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150 ease-in-out">Search</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($carsForRent) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($carsForRent as $car)
                                <div class="rounded overflow-hidden shadow-lg">
                                    <img class="w-full h-48 object-cover" src="{{ $car->images->first()->image_path ?? asset('https://media.ed.edmunds-media.com/toyota/corolla/2023/oem/2023_toyota_corolla_sedan_xse_fq_oem_1_815.jpg') }}" alt="Car image">
                                    <div class="px-6 py-4">
                                        <div class="font-bold text-xl mb-2">{{ $car->make }} {{ $car->model }}</div>
                                        <p class="text-gray-700 text-base">
                                            Year: {{ $car->year }}<br>
                                            Price: ${{ number_format($car->price, 2) }}/day<br>
                                            Status: {{ ucfirst($car->status) }}
                                        </p>
                                    </div>
                                    <div class="px-6 pt-4 pb-2 flex justify-between items-center">
                                        <a href="{{ route('cars.show', $car) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">View</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No cars available for rent at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
