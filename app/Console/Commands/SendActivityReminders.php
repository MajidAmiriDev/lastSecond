<?php

namespace App\Console\Commands;

use App\Jobs\SendActivityReminder;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SendActivityReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:activity-reminders';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders to users 24 hours before their activity starts';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $targetTime = $now->copy()->addDay();

        $bookings = Booking::whereHas('activity', function($query) use ($targetTime) {
            $query->whereBetween('start_time', [$targetTime->startOfHour(), $targetTime->endOfHour()]);
        })->get();

        foreach ($bookings as $booking) {
            SendActivityReminder::dispatch($booking);
        }

        return 0;
    }
}
