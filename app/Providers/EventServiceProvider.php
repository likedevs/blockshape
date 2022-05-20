<?php

namespace App\Providers;

use App\ConstitutionType;
use App\Events\DocumentConfirmed;
use App\Events\QiwiPayment;
use App\Events\UserHistoryCreated;
use App\Events\UserRequestedEmailConfirmation;
use App\Events\VbPayment;
use App\FigureType;
use App\LanguageKeyTranslation;
use App\Listeners\CompletePayment;
use App\Listeners\EmailDocumentToCustomer;
use App\Listeners\QiwiPaymentEmail;
use App\Listeners\SendEmailConfirmationToken;
use App\Listeners\SendUserHistoryDocumentCreatedNotification;
use App\Listeners\VbPaymentEmail;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use App\Order;
use App\Recipe;
use App\User;
use App\UserHistory;
use App\Observers\UserHistoryObserver;
use Artisan;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /**
         * Flow from completing the Users Quiz up to Downloading the Document:
         * 1. Instructor created record -> Notify admin
         * 2. Document confirmed|rejected => Notify instructor (Broadcast)
         */
        UserHistoryCreated::class => [
            SendUserHistoryDocumentCreatedNotification::class
        ],

        UserRequestedEmailConfirmation::class => [
            SendEmailConfirmationToken::class
        ],

        DocumentConfirmed::class => [
            CompletePayment::class,
            EmailDocumentToCustomer::class
        ],

        QiwiPayment::class => [
            QiwiPaymentEmail::class
        ],

        VbPayment::class => [
            VbPaymentEmail::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        UserHistory::observe(UserHistoryObserver::class);

        Order::observe(OrderObserver::class);

        ConstitutionType::saving(function ($row) {
            if (($note = \Input::get('note')) && is_array($note)) {
                unset($row['note[weight-loss]']);
                unset($row['note[weight-gain]']);
                unset($row['note[maintenance]']);
                $row->note = $note;
            }

            return $row;
        });

        FigureType::saving(function ($row) {
            if (($note = \Input::get('description')) && is_array($note)) {
                unset($row['description[weight-loss]']);
                unset($row['description[weight-gain]']);
                unset($row['description[maintenance]']);
                $row->description = $note;
            }

            return $row;
        });

        User::observe(UserObserver::class);

        LanguageKeyTranslation::updated(function (LanguageKeyTranslation $translation) {
            if ($translation->isDirty('value')) {
                Artisan::call('translations:dump');
            }
        });
    }
}