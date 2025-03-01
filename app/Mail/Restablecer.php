<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Restablecer extends Mailable
{
    use Queueable, SerializesModels;
    public $correo;
    public $contraseña;
    /**
     * Create a new message instance.
     */
    public function __construct($correo,$contraseña)
    {
        $this->correo=$correo;
        $this->contraseña=$contraseña;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Restablecer',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.usuario.restablecer',
            with: [
                'correo' => $this->correo,
                'contraseña' => $this->contraseña,
            ],
        );
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
