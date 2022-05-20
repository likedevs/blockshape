<?php

namespace App\Listeners;

use App\Events\UserHistoryCreated;
use Illuminate\Mail\Message;
use Mail;
use Terranet\Administrator\Model\Settings;

class SendUserHistoryDocumentCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param UserHistoryCreated $event
     */
    public function handle(UserHistoryCreated $event)
    {
        $data = $event->getRecord();

        $payload = [
            'instructor' => $data->instructor ? $data->instructor->name : null,
            'url' => route('admin_model_index', ['page' => 'history_records'])
        ];

        Mail::send('emails.admin.record', $payload, function (Message $message) {
            $message->from($adminEmail = Settings::getOption('admin::email'));
            $message->to($adminEmail);
            $message->subject(trans('emails.admin.record.subject'));
        });
    }
}
