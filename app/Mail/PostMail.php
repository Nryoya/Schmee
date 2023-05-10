<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Article;
use Illuminate\Mail\Mailables\Address;


class PostMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $article;
    private $url;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Article $article)
    {
        //
        $this->user = $user;
        $this->article = $article;
        $this->url = route('articleDetail', ['id' => $this->article->id]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('Schmee.info@gmail.com', 'schmee'),
            subject: '学校通信メール',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.post_mail',
            with: [
                'user' => $this->user,
                'article' => $this->article,
                'url' => $this->url,
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
