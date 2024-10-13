<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $password; // Variable pública para el usuario
 
    public function __construct(User $user, $password)
    {
        $this->user = $user; // Asignar usuario
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Registro exitoso en nuestra plataforma MARKETCRAFT')
                    ->view('emails.user-registered');
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Registro Exitoso',
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
