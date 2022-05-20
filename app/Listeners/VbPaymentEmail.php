<?php

namespace App\Listeners;

use App\Events\VbPayment;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Terranet\Administrator\Model\Settings;

class VbPaymentEmail
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
        //
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  VbPayment $event
     * @return void
     */
    public function handle(VbPayment $event)
    {
        $order = $event->order;
        $user = $order->userHistory->user;

        $this->mailer->send('emails.vb.ro.payment_ok', [
            'name'     => $user->name,
            'order'    => $order,
            'merchant' => app('vb-merchant')
        ], function (Message $message) use ($user) {
            $message->from(Settings::getOption('from::email'), Settings::getOption('from::name'));
            $message->to($user->email);
            $message->subject(trans('user.emails.vb_payment.subject'));
        });
    }
}
