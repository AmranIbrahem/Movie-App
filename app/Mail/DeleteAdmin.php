<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeleteAdmin extends Mailable
{
    use Queueable, SerializesModels;
    protected $link;
    protected $name;


    /**
     * Create a new message instance.
     */
    public function __construct($name,$link)
    {
        $this->name=$name;
        $this->link=$link;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Delete Admin',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.DeleteAdmin',
        );
    }
    public function build()
    {
        return $this->subject('Delete Admin')
            ->view('emails.DeleteAdmin')
            ->with(['name' => $this->name,'link'=>$this->link]);
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
