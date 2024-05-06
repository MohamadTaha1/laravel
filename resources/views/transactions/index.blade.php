<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Transactions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Buy Requests</h3>
                @foreach($buyRequests as $request)
                <div class="p-2 mt-2 bg-blue-100 rounded-lg">
                    Car: {{ $request->car->make }} {{ $request->car->model }} <br>
                    Status: {{ $request->status }} <br>
                    Requested On: {{ $request->created_at->format('Y-m-d') }}
                </div>
                @endforeach

                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-6">Rent Requests</h3>
                @foreach($rentRequests as $request)
                <div class="p-2 mt-2 bg-yellow-100 rounded-lg">
                    Car: {{ $request->car->make }} {{ $request->car->model }} <br>
                    Status: {{ $request->status }} <br>
                    Rent Start: {{ $request->rent_start }} <br>
                    Rent End: {{ $request->rent_end }} <br>
                    Requested On: {{ $request->created_at->format('Y-m-d') }}
                </div>
                @endforeach

                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-6">Transactions</h3>
                @foreach($transactions as $transaction)
                <div class="p-2 mt-2 bg-green-100 rounded-lg">
                    Car ID: {{ $transaction->car_id }} <br>
                    Type: {{ $transaction->type }} <br>
                    Amount: {{ $transaction->amount }} <br>
                    <p>Contact: <span class="font-semibold">{{ $transaction->user->phone }}</span></p> <!-- Display phone number -->

                    Status: Accepted <br>
                    Date: {{ $transaction->created_at->format('Y-m-d') }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
