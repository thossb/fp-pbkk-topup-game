<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $email, private $user_name, private $transaction_created_at, private $transaction_id, private $game_name, private $game_unit, private $denom_denom, private $denom_price)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Invoice Felixe',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.order-notification',
            with: [
                'email' => $this->email,
                'name' => $this->user_name,
                'transaction_date' => $this->transaction_created_at,
                'transaction_id' => $this->transaction_id,
                'game' => $this->game_name,
                'unit' => $this->game_unit,
                'denom' => $this->denom_denom,
                'price' => $this->denom_price,
            ]
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
