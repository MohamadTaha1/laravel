<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Car Bidding Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Display for owners to list their cars for bidding --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mb-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">List Your Car for Bidding</h3>
                @foreach($userCars as $car)
                    @if($car->price >= 2000000)
                        <div class="p-2 mt-2 bg-blue-100 rounded-lg">
                            Car: {{ $car->make }} {{ $car->model }} - {{ number_format($car->price, 2) }}<br>
                            @if(!$car->is_for_bidding)
                                <form method="POST" action="{{ route('bidding.setup', $car->id) }}">
                                    @csrf
                                    <input type="number" name="start_price" placeholder="Start Price" required class="border-gray-300 rounded">
                                    <input type="datetime-local" name="bid_start_time" required class="border-gray-300 rounded">
                                    <input type="datetime-local" name="bid_end_time" required class="border-gray-300 rounded">
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-300">Setup Bidding</button>
                                </form>
                            @else
                                <span class="text-green-500">Already listed for bidding.</span>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Display for all users to see cars available for bidding --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Cars Available for Bidding</h3>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($carsForBidding as $car)
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <img src="{{ $car->images->first()->image_path ?? 'Default image URL' }}" alt="{{ $car->make }} image" class="w-full h-56 object-cover">
                            <div class="mt-2">
                                <h4>{{ $car->make }} {{ $car->model }}</h4>
                                <p>Current Bid: ${{ $car->bids->max('amount') ?? $car->start_price }}</p>
                                <p>Bid Ends: {{ $car->bid_end_time->format('Y-m-d H:i:s') }}</p>
                                <a href="{{ route('bidding.bid', $car->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300">View & Bid</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
