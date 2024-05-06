<div x-data="{ openModal: false }">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <img src="{{ $car->images->first()->image_path ?? 'Default image URL' }}" alt="Car Image" class="w-full h-auto">
                    </div>
                    <h3 class="text-lg font-semibold">{{ $car->make }} {{ $car->model }}</h3>
                    <p>Year: {{ $car->year }}</p>
                    <p>Price: ${{ number_format($car->price, 2) }}</p>
                    <p>Rent Price: ${{ number_format($car->rent_price, 2) }}</p>
                    <p>Status: {{ ucfirst($car->status) }}</p>
                    <p>Description: {{ $car->description }}</p>
                    <div class="flex mt-6">
                        {{-- Conditionally show Edit and Delete buttons only to the car's owner --}}
                        @if(Auth::id() === $car->user_id)
                        <button style="background-color: #3182ce; color: white; padding: 8px 16px; border-radius: 0.25rem; text-decoration: none; display: inline-block; margin-right: 16px;">  <a href="{{ route('cars.edit', $car->id) }}" >
                            Edit
                        </a></button>
                        <div style="background-color: #e53e3e; color: white; padding: 8px 16px; border: none; border-radius: 0.25rem; cursor: pointer; display: inline-block;">
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDeletion();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                                    Delete
                                </button>
                            </form>
                        </div>

                        @endif

                        @if($car->is_for_sale && Auth::id() !== $car->user_id)
                        <div style="background-color: #4CAF50; color: white; padding: 8px 16px; border: none; border-radius: 0.25rem; cursor: pointer; display: inline-block; margin-right: 16px;">
                            <form action="{{ route('cars.buy.request', $car->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                                    Buy
                                </button>
                            </form>
                        </div>
                        @endif


                        

                        {{-- Show Rent button if the car is for rent and the current user is not the owner --}}
                        @if($car->is_for_rent && Auth::id() !== $car->user_id)
                            <button @click="openModal = true" class="ml-4 bg-blue-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Rent
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<div x-show="openModal" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        ...
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
            <form method="POST" action="{{ route('cars.rent.request', $car->id) }}">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                Rent {{ $car->make }} {{ $car->model }}
                            </h3>
                            <div class="mt-2">
                                <input type="text" id="rent_start" name="rent_start" class="border p-2 rounded mr-2" placeholder="Start Date" required>
                                <input type="text" id="rent_end" name="rent_end" class="border p-2 rounded" placeholder="End Date" required>
                                <input type="text" name="pickup_location" class="border p-2 rounded mt-2" placeholder="Pickup Location" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm
                    </button>
                    <button type="button" @click="openModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('rentModal', () => ({
        openModal: false,
    }));

    flatpickr("#rent_start", {
        enableTime: false,
        dateFormat: "Y-m-d",
        onChange: function(selectedDates) {
            const startDate = selectedDates[0];
            flatpickr("#rent_end", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: startDate,
            });
        }
    });

    flatpickr("#rent_end", {enableTime: false, dateFormat: "Y-m-d"});
});

</script>

<script>
function confirmDeletion() {
    return confirm('Are you sure you want to delete this car?');
}
</script>


