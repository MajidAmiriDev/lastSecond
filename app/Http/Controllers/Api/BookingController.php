<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\BookingRequest;
use App\Jobs\SendBookingConfirmation;
use App\Notifications\AdminBookingNotification;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        $data = $request->validated();

        $activity = Activity::findOrFail($data['activity_id']);

        if ($activity->available_slots < $data['slots_booked']) {
            return response()->json(['error' => 'Not enough available slots.'], 400);
        }
        $data['status'] = 'pending';
        $booking = Booking::create($data);
        SendBookingConfirmation::dispatch($booking);

        $admin = User::where('email', 'admin@example.com')->first(); // Adjust to your admin's email
        if ($admin) {
            $admin->notify(new AdminBookingNotification($booking));
        }
        
        $activity->decrement('available_slots', $data['slots_booked']);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized to cancel this booking.'], 403);
        }

        if ($booking->status == 'cancelled') {
            return response()->json(['error' => 'Booking is already cancelled.'], 400);
        }

        $activity = Activity::findOrFail($booking->activity_id);

        // Update booking status to 'cancelled'
        $booking->update(['status' => 'cancelled']);

        // Restore the available slots
        $activity->increment('available_slots', $booking->slots_booked);

        return response()->json(['message' => 'Booking has been cancelled.'], 200);
    }
    
}
