<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Envelope, Address, Content};
use Illuminate\Queue\SerializesModels;

final class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('rehor.ger@gmail.com', 'Grigory G'),
            to: [
                new Address($this->user->email)
            ],
            cc: [
                new Address('rehor.ger@seznam.cz', 'Grigory G')
            ],
            bcc: [
                new Address('rehor.ger@seznam.cz', 'Grigory G')
            ],
            subject: 'Registration Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth.registrationmail',
            with: [
                'userName' => $this->user->name
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
