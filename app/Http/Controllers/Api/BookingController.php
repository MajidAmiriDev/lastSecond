<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\BookingRequest;
use App\Jobs\SendBookingConfirmation;


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
}
