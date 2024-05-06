{{-- resources/views/bidding/setup.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Setup Bidding for {{ $car->make }} {{ $car->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('bidding.submitSetup', ['car' => $car->id]) }}" method="POST">
                    @csrf
                    <div>
                        <label for="start_price" class="block text-sm font-medium text-gray-700">Starting Price:</label>
                        <input id="start_price" name="start_price" type="number" required class="mt-1 block w-full" placeholder="Enter starting price">
                    </div>
                    <div class="mt-4">
                        <label for="bid_start_time" class="block text-sm font-medium text-gray-700">Start Time:</label>
                        <input id="bid_start_time" name="bid_start_time" type="datetime-local" required class="mt-1 block w-full">
                    </div>
                    <div class="mt-4">
                        <label for="bid_end_time" class="block text-sm font-medium text-gray-700">End Time:</label>
                        <input id="bid_end_time" name="bid_end_time" type="datetime-local" required class="mt-1 block w-full">
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-button class="ml-4">
                            Submit
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
