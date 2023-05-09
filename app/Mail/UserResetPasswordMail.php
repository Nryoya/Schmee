<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
Use App\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class UserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;
    private $tokenParam;
    private $now;
    private $url;

    /**
     * コンストラクト
     * 
     * @param User $user
     * @param  UserToken $userToken
     */
    public function __construct(User $user, UserToken $userToken)
    {
        $this->user = $user;
        $this->userToken = $userToken;
        $this->tokenParam = ['reset_token' => $this->userToken->token];
        $this->now = Carbon::now();
        // 48時間後を期限とした署名付きURLを生成
        $this->url = URL::temporarySignedRoute('password_reset.edit', $this->now->addHours(48), $this->tokenParam);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('Schmee.info@gmail.com', 'schmee'),
            subject: 'パスワード再設定用メール',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.password_reset_mail',
            with: [
                'user' => $this->user,
                'url' => $this->url
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
