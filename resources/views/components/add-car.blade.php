

<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 my-10">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5 bg-gradient-to-br from-blue-200 to-indigo-400">
        <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Add New Car</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Fill in the details below to list your car.</p>
            </div>

            {{-- Make --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Make</label>
                <input type="text" name="make" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            {{-- Model --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Model</label>
                <input type="text" name="model" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            {{-- Year --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Year</label>
                <input type="number" name="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            {{-- VIN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">VIN</label>
                <input type="text" name="vin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            {{-- Status --}}
            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                <input type="text" name="status" value="available" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required readonly>
            </div>


            {{-- Price --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price ($)</label>
                <input type="number" step="0.01" name="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            {{-- Rent Price --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Rent Price ($)</label>
                <input type="number" step="0.01" name="rent_price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"></textarea>
            </div>

            {{-- Image Upload --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Car Image</label>
                <input type="file" name="image" class="mt-1 block w-full" required="">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-6 py-3 bg-blue-500 hover:bg-blue-700 text-white rounded-full font-medium transition duration-300">Upload Car</button>
            </div>
        </form>
    </div>
</div>


