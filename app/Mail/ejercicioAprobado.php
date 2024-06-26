<?php

namespace App\Mail;

use App\Models\Ejercicio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EjercicioAprobado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ejercicio;

    public function __construct(Ejercicio $ejercicio)
    {
        $this->ejercicio = $ejercicio;
    }


    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.ejercicio_aprobado')
            ->subject('Tu ejercicio ha sido aprobado');
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
