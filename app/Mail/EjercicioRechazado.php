<?php

namespace App\Mail;

use App\Models\Ejercicio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EjercicioRechazado extends Mailable
{
    use Queueable, SerializesModels;

    public $ejercicio;

    public function __construct(Ejercicio $ejercicio)
    {
        $this->ejercicio = $ejercicio;
    }

    public function build()
    {
        return $this->view('emails.ejercicio_rechazado')
            ->subject('Tu ejercicio ha sido rechazado');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
