<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">
    <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
        My Transactions and Requests
    </h2>

    {{-- Transactions --}}
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-700">Transactions</h3>
        <div class="mt-4 space-y-4">
            @foreach($user->transactions as $transaction)
                <div class="p-4 bg-white rounded-lg shadow">
                    <p>Type: <span class="font-semibold">{{ $transaction->type }}</span></p>
                    <p>Amount: <span class="font-semibold">${{ number_format($transaction->amount, 2) }}</span></p>
                    <p>Contact: <span class="font-semibold">{{ $transaction->user->phone }}</span></p> <!-- Display phone number -->
                    <!-- Add more transaction details as needed -->
                </div>
            @endforeach
        </div>
    </div>

    {{-- Buy Requests --}}
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-700">Buy Requests</h3>
        <div class="mt-4 space-y-4">
            @foreach($user->buyRequests->where('status', 'pending') as $request)
                <div class="flex justify-between items-center p-4 bg-white rounded-lg shadow">
                    <div>
                    <p>Contact: <span class="font-semibold">{{ $transaction->user->phone }} <!-- Display phone number -->
</span> - Car: <span class="font-semibold">{{ $request->car->make }} {{ $request->car->model }}</span></p>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="updateRequestStatus('{{ $request->id }}', 'accepted', 'buy')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-300">Accept</button>
                        <button onclick="updateRequestStatus('{{ $request->id }}', 'declined', 'buy')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition duration-300">Decline</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Rent Requests --}}
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-700">Rent Requests</h3>
        <div class="mt-4 space-y-4">
            @foreach($user->rentRequests->where('status', 'pending') as $request)
                <div class="flex justify-between items-center p-4 bg-white rounded-lg shadow">
                    <div>
                        <p>Request ID: <span class="font-semibold">{{ $request->id }}</span> - Car: <span class="font-semibold">{{ $request->car->make }} {{ $request->car->model }}</span></p>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="updateRequestStatus('{{ $request->id }}', 'accepted', 'rent')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-300">Accept</button>
                        <button onclick="updateRequestStatus('{{ $request->id }}', 'declined', 'rent')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition duration-300">Decline</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function updateRequestStatus(requestId, status, type) {
    let url = '';
    if (type === 'buy') {
        url = `/buy-requests/${requestId}/respond`;
    } else if (type === 'rent') {
        url = `/rent-requests/${requestId}/respond`;
    }

    fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);
        window.location.reload();
    })
    .catch(error => console.error('Error:', error));
}


</script>
