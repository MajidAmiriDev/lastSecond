<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class EnsureBookingOwner
{
    public function handle(Request $request, Closure $next)
    {
        $booking = Booking::find($request->route('id'));

        if (!$booking || $booking->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized to perform this action.'], 403);
        }

        return $next($request);
    }
}
