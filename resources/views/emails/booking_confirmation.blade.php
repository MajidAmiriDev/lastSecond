<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Thank you for your booking, {{ $booking->user_name }}!</h1>
    <p>You have booked {{ $booking->slots_booked }} slots for the activity: {{ $booking->activity->name }}.</p>
    <p>Location: {{ $booking->activity->location }}</p>
    <p>Price: ${{ $booking->activity->price }}</p>
    <p>Status: {{ $booking->status }}</p>
</body>
</html>