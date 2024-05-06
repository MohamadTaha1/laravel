<!-- resources/views/components/car-list.blade.php -->

@props(['cars'])

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-6">
        @foreach ($cars as $car)
            <div class="rounded-lg shadow-lg overflow-hidden bg-gradient-to-br from-blue-200 to-indigo-400">
                <img class="object-cover w-full h-56" src="{{ $car->images->first()->image_path ?? asset('https://media.ed.edmunds-media.com/toyota/corolla/2023/oem/2023_toyota_corolla_sedan_xse_fq_oem_1_815.jpg') }}" alt="{{ $car->make }} {{ $car->model }}">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white">{{ $car->make }} {{ $car->model }}</h3>
                    <p class="text-sm text-gray-200">Year: {{ $car->year }}</p>
                    <p class="text-sm text-gray-200">Price: ${{ number_format($car->price, 2) }}</p>
                    <p class="text-sm text-gray-200">Status: {{ ucfirst($car->status) }}</p>
                    <p class="mt-3 text-gray-200">{{ $car->description }}</p>
                    <div class="mt-4 grid grid-cols-1 gap-4">
                        <a href="{{ route('cars.edit', $car) }}" class="block px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition duration-300 ease-in-out text-center">Edit</a>

                        <!-- Sale Toggle Form -->
                        <form action="{{ route('cars.sale', $car) }}" class="w-full px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-300 ease-in-out text-center" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="...">
                                {{ $car->is_for_sale ? 'Remove from Sale' : 'Put for Sale' }}
                            </button>
                        </form>

                        <!-- Rent Toggle Form -->
                        <form action="{{ route('cars.rent', $car) }}" class="w-full px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition duration-300 ease-in-out text-center" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="...">
                                {{ $car->is_for_rent ? 'Remove from Rent' : 'Put for Rent' }}
                            </button>
                        </form>


                        <a href="{{ route('cars.show', $car) }}" class="block px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-lg transition duration-300 ease-in-out text-center">View</a>

                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDeletion(this.form)" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition duration-300 ease-in-out">Delete</button>
                        </form>
                    </div>



                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
function confirmDeletion(form) {
    if (confirm('Are you sure you want to delete this car?')) {
        form.submit();
    }
}
</script>