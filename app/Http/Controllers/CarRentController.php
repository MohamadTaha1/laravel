<?php
namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\RentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class CarRentController extends Controller
{
    public function index(Request $request)
    {
        // Start with all cars that are available for rent
        $query = Car::query()->where('is_for_rent', true)->where('user_id', '!=', auth()->id());
    
        // If there is a search term, filter by it
        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('make', 'like', '%' . $search . '%')
                  ->orWhere('model', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
                // Add other fields you want to search by
            });
        }
    
        // If there are additional filters, apply them
        // Example: Filtering by year
        if ($year = $request->query('year')) {
            $query->where('year', '=', $year);
        }
    
        // Example: Filtering by price range
        if ($minPrice = $request->query('min_price') && $maxPrice = $request->query('max_price')) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }
    
        // Retrieve the filtered and paginated results
        $carsForRent = $query->paginate(10);
    
        // Return the view with the filtered results
        return view('rent', compact('carsForRent'));
    }
    
    public function rentRequest(Request $request, Car $car)
    {
        $request->validate([
            'rent_start' => 'required|date',
            'rent_end' => 'required|date|after_or_equal:rent_start',
            'pickup_location' => 'required|string',
        ]);

        RentRequest::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'owner_id' => $car->user_id,
            'status' => 'pending',
            'rent_start' => $request->rent_start,
            'rent_end' => $request->rent_end,
            'pickup_location' => $request->pickup_location,
        ]);

        // Assuming you have a route named 'transactions.index' that leads to your transactions page.
        return redirect()->route('transactions.index')->with('success', 'Rent request submitted successfully.');
    }


    public function respondToRentRequest(Request $request, RentRequest $rentRequest)
{
    if (Auth::id() !== $rentRequest->owner_id) {
        return response()->json(['error' => 'Unauthorized action'], 403);
    }

    $rentRequest->update(['status' => $request->status]);

    if ($request->status === 'accepted') {
        // Calculate the number of days of the rent period
        $rentStart = \Carbon\Carbon::parse($rentRequest->rent_start);
        $rentEnd = \Carbon\Carbon::parse($rentRequest->rent_end);
        $daysOfRent = $rentEnd->diffInDays($rentStart) + 1; // +1 to include both start and end dates

        // Fetch the car to get its rent price per day
        $car = $rentRequest->car; // Assuming you have the relationship set up in the RentRequest model
        
        if (!$car->rent_price) {
            return response()->json(['error' => 'Rent price not set for this car'], 422);
        }
        
        // Calculate the rent amount based on the number of rental days and the car's daily rent price
        $rentAmount = $car->rent_price * $daysOfRent;

        // Create a transaction for the rent request
        Transaction::create([
            'user_id' => $rentRequest->user_id,
            'car_id' => $rentRequest->car_id,
            'type' => 'rent',
            'amount' => $rentAmount, // Use the calculated rent amount
        ]);
    }

    return response()->json(['success' => true, 'message' => 'Rent request ' . $request->status]);
}



}
