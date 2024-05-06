{{-- resources/views/bidding/show.blade.php --}}

                

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bidding on {{ $car->make }} {{ $car->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="md:w-2/3">
                   
                        <img src="{{ $car->images->first()->image_path ?? 'path/to/default-car-image.jpg' }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-64 object-cover">
                    </div>
                <div >
                
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Car Details</h3>
                    <p>Model: {{ $car->make }} {{ $car->model }}</p>
                    <p>Start Price: ${{ number_format($car->start_price) }}</p>
                    <p>Bidding Ends: {{ \Carbon\Carbon::parse($car->bid_end_time)->setTimezone('Africa/Cairo')->toDayDateTimeString() }}</p>
                </div>
                <div class="mt-4">
                    @if(\Carbon\Carbon::parse($car->bid_end_time)->isPast())
                        @if($car->bids->isNotEmpty())
                            <p>The winner is: {{ $car->bids->sortByDesc('amount')->first()->user->name }} with a bid of ${{ number_format($car->bids->sortByDesc('amount')->first()->amount) }}</p>
                        @else
                            <p>No bids were placed.</p>
                        @endif
                    @else
                        <form action="{{ route('bidding.bid', ['car' => $car->id]) }}" method="post">
                            @csrf
                            <input type="number" name="amount" placeholder="Enter your bid" required class="border-gray-300 rounded-md shadow-sm mt-1 block w-full">
                            <x-button class="mt-3">
                                Place Bid
                            </x-button>
                        </form>
                    @endif
                </div>
                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900">Previous Bids</h4>
                    @forelse ($car->bids as $bid)
                        <p>{{ $bid->user->name }}: ${{ number_format($bid->amount) }} - {{ $bid->created_at->diffForHumans() }}</p>
                    @empty
                        <p>No bids yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
