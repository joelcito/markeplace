<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarCorreoSuscripcion extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $tipo;
    public $modalidad;
    public $qr;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $tipo, $modalidad, $qr)
    {
        $this->name = $nombre;
        $this->tipo = $tipo;
        $this->modalidad = $modalidad;
        $this->qr = $qr;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'CORREO DE SUSCRIPCION',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.suscripcion',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
