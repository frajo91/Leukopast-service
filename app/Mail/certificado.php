<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Attachment;



class certificado extends Mailable
{
    use Queueable, SerializesModels;

    private $usuario;
    /**
     * Create a new message instance.
     */
    public function __construct($usuario)
    {
        $this->usuario=$usuario;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('messages.asunto_certificado'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.certificado.certificado',
            with: [
                'usuario' => $this->usuario,
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
        $pdf = Pdf::loadView('certificado', ['usuario' => $this->usuario])->setPaper('11x17', 'landscape');
        return [  
            Attachment::fromData(fn () => $pdf->output(), 'Certificado.pdf')
                ->withMime('application/pdf'),
            ];
    }
}