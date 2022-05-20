<?php

namespace App\Listeners;

use App\Events\UserRequestedEmailConfirmation;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Terranet\Administrator\Model\Settings;

class SendEmailConfirmationToken
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRequestedEmailConfirmation  $event
     * @return void
     */
    public function handle(UserRequestedEmailConfirmation $event)
    {
        $this->mailer->send('emails.register.token', [
            'email' => $event->email,
            'token' => $event->token
        ], function (Message $message) use ($event) {
            $message->from(Settings::getOption('from::email'), Settings::getOption('from::name'));
            $message->to($event->email);
            $message->subject(trans('user.emails.token.subject'));
        });
    }
}
