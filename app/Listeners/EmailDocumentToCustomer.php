<?php

namespace App\Listeners;

use App\Events\DocumentConfirmed;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Terranet\Administrator\Model\Settings;

class EmailDocumentToCustomer
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
     * @param  DocumentConfirmed  $event
     * @return void
     */
    public function handle(DocumentConfirmed $event)
    {
        $record = $event->record;
        $user = $record->user;

        if (($user instanceof User) && $user->isOnline()) {
            $download = route('customer.history.user-download', [
                'user' => $user,
                'record' => $record,
                'token' => download_tnf_token($user, $record)
            ]);

            $this->mailer->queue(
                'emails.history.confirmed',
                ['user' => $user, 'download' => $download],
                function (Message $message) use ($user) {
                    $message->from(Settings::getOption('from::email'), Settings::getOption('from::name'));
                    $message->to($user->email, $user->name);
                    $message->subject(trans('user.emails.document.subject'));
                }
            );
        }
    }
}
