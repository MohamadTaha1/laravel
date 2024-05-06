<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BiddingController extends Controller
{
    // Display all available cars for bidding and cars that can be set up for bidding
    public function index()
    {
        $userCars = Auth::user()->cars()->where('price', '>=', 2000000)->get(); // Cars eligible for bidding setup
        $carsForBidding = Car::where('is_for_bidding', true)->with('bids')->get(); // Cars currently up for bidding
        return view('bidding.index', compact('userCars', 'carsForBidding'));
    }

    // Show the setup form to configure a car for bidding
    public function showSetup(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('bidding.setup', compact('car'));
    }

    // Process the setup form and list the car for bidding
    public function setupBidding(Request $request, Car $car)
{
    if ($car->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'start_price' => 'required|numeric|min:2000000',
        'bid_start_time' => 'required|date|after_or_equal:now',
        'bid_end_time' => 'required|date|after:bid_start_time'
    ]);

    $car->update([
        'is_for_bidding' => true,
        'start_price' => $request->start_price,
        'bid_start_time' => $request->bid_start_time,
        'bid_end_time' => $request->bid_end_time
    ]);

    return redirect()->route('bidding.index')->with('success', 'Your car is now listed for bidding!');
}


    // Display details of a specific car and allow users to place bids
    public function show(Car $car)
    {
        $bids = $car->bids()->with('user')->orderByDesc('amount')->get();
        return view('bidding.show', compact('car', 'bids'));
    }

    // Handle bid placements on a car
    public function placeBid(Request $request, Car $car)
    {
        if (!$car->is_for_bidding || $car->bid_end_time <= now()) {
            return back()->with('error', 'Bidding for this car is not active or has ended.');
        }

        $request->validate([
            'amount' => 'required|numeric|gt:' . ($car->bids()->max('amount') ?? $car->start_price)
        ]);

        $car->bids()->create([
            'user_id' => Auth::id(),
            'amount' => $request->amount
        ]);

        return back()->with('success', 'Bid placed successfully.');
    }
}
