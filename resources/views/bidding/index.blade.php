<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Car Bidding
        </h2>
    </x-slot>

    <!-- Section for users to list their cars for bidding -->
    @if($userCars->where('price', '>=', 2000000)->count() > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <h3 class="text-lg font-medium text-gray-900">List Your Car for Bidding</h3>
            <p>Only cars valued at $2,000,000 or more can be listed for bidding.</p>
            @foreach($userCars->where('price', '>=', 2000000) as $car)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Car: {{ $car->make }} {{ $car->model }} - ${{ number_format($car->price) }}
                    </label>
                    <a href="{{ route('bidding.setup', ['car' => $car->id]) }}" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Start Bidding
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Section to display cars available for bidding to all users -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Cars Available for Bidding</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    @forelse ($carsForBidding as $car)
                        <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                            <h4 class="font-bold text-xl">{{ $car->make }} {{ $car->model }}</h4>
                            <div>Start Price: ${{ number_format($car->start_price) }}</div>
                            <div>Ends: {{ \Carbon\Carbon::parse($car->bid_end_time)->diffForHumans() }}</div>
                            <a href="{{ route('bidding.show', ['car' => $car->id]) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                View and Bid
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500">No cars are currently available for bidding.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
