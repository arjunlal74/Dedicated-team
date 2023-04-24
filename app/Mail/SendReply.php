<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendReply extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $replyMessage;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->subject = $data[0];
        $this->replyMessage = $data[1];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {   $reply_message = $this->replyMessage;
        return new Content(
            markdown: 'emails.replyMail',
            with: [
                'reply_message' => $reply_message
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
