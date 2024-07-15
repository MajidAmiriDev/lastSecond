<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Activity Reminder</title>
</head>
<body>
    <h1>Hi {{ $booking->user_name }},</h1>
    <p>This is a reminder for your upcoming activity:</p>
    <p><strong>Activity:</strong> {{ $booking->activity->name }}</p>
    <p><strong>Date:</strong> {{ $booking->activity->start_time->format('Y-m-d H:i:s') }}</p>
    <p><strong>Location:</strong> {{ $booking->activity->location }}</p>
    <p>We look forward to seeing you!</p>
    <p>Thank you for using our service.</p>
</body>
</html>