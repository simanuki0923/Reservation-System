<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->view('mail.reservation_confirmation')
                    ->with([
                        'reservation' => $this->reservation,
                        'qrCodeContent' => $this->reservation->qr_code,
                    ]);
    }
}