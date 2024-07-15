<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminBookingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Booking Created')
                    ->line('A new booking has been made.')
                    ->line('Activity: ' . $this->booking->activity->name)
                    ->line('User: ' . $this->booking->user_name)
                    ->line('Email: ' . $this->booking->user_email)
                    ->line('Slots Booked: ' . $this->booking->slots_booked)
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'activity_name' => $this->booking->activity->name,
            'user_name' => $this->booking->user_name,
            'user_email' => $this->booking->user_email,
            'slots_booked' => $this->booking->slots_booked,
        ];
    }
}