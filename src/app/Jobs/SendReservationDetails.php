<?php

namespace App\Jobs;

use App\Mail\ReservationConfirmation;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReservationDetails implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function handle()
    {
        try {
            // メールの送信
            Mail::to($this->reservation->user->email)
                ->send(new ReservationConfirmation($this->reservation));
        } catch (\Exception $e) {
            \Log::error('Error sending reservation details: ' . $e->getMessage());
        }
    }
}