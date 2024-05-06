<?php namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\BuyRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\RentRequest;
use Illuminate\Support\Facades\Log; // Add this line




class CarSaleController extends Controller
{
    public function index(Request $request)
    {
        // Add filters and search functionality based on request parameters
        $query = Car::where('is_for_sale', true)->where('user_id', '!=', auth()->id());


        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('make', 'LIKE', "%{$search}%")
                  ->orWhere('model', 'LIKE', "%{$search}%");
            });
        }

        $carsForSale = $query->get();

        return view('buy', compact('carsForSale'));
    }

    public function buyRequest(Request $request, Car $car)
    {
        Log::info("Buy request initiated for car ID: {$car->id}");

        $existingRequest = BuyRequest::where('car_id', $car->id)
                                     ->where('user_id', auth()->id())
                                     ->whereIn('status', ['pending', 'accepted'])
                                     ->first();
        if ($existingRequest) {
            return back()->with('error', 'You have already made a request for this car.');
        }
        $pendingRequests = BuyRequest::where('car_id', $car->id)
                                      ->where('status', 'pending')
                                      ->count();

        if ($pendingRequests > 0) {
            return back()->with('error', 'This car is currently under review by another buyer.');
        }
        $buyRequest = new BuyRequest([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'owner_id' => $car->user_id,
            'status' => 'pending',
        ]);
        $buyRequest->save();

    return redirect()->route('transactions.index')->with('success', 'Buy request sent successfully.');

    }

    public function myTransactions()
{
    $userId = Auth::id();

    $transactions = Transaction::with('user')->where('user_id', $userId)->orderByDesc('created_at')->get();
    $buyRequests = BuyRequest::with(['car', 'car.user'])->where('user_id', $userId)->where('status', 'pending')->get();
    $rentRequests = RentRequest::with(['car', 'car.user'])->where('user_id', $userId)->where('status', 'pending')->get();

    return view('transactions.index', compact('transactions', 'buyRequests', 'rentRequests'));
}


public function respondToBuyRequest(Request $request, BuyRequest $buyRequest)
{
    // Ensure the authenticated user is the owner of the car associated with the buy request
    if (Auth::id() !== $buyRequest->owner_id) {
        return response()->json(['error' => 'Unauthorized action'], 403);
    }

    // Update the buy request status
    $buyRequest->update(['status' => $request->status]);

    if ($request->status === 'accepted') {
        // Change the ownership of the car
        $car = $buyRequest->car;

        // Delete all transactions related to this car before transferring ownership
        Transaction::where('car_id', $car->id)->delete();

        // Create a transaction for the sale under the new owner
        Transaction::create([
            'user_id' => $buyRequest->user_id, // New owner ID
            'car_id' => $car->id,
            'type' => 'buy',
            'amount' => $car->price,
        ]);

        // Now change the ownership
        $car->user_id = $buyRequest->user_id;
        $car->save();

        // Delete all existing buy and rent requests for this car
        BuyRequest::where('car_id', $car->id)->delete();
        RentRequest::where('car_id', $car->id)->delete();

        return response()->json(['success' => true, 'message' => 'Car sold and ownership changed. All related transactions and requests deleted.']);
    } else {
        // Simply decline the request without changing ownership or creating a transaction
        return response()->json(['success' => true, 'message' => 'Buy request declined.']);
    }
}


    

}    