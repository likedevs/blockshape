<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => '',
        'secret' => '',
    ],

    /**
     * Victoria bank
     */
    'victoria' => [
        'merchant' => '498000049892083',
        'terminal' => '49892083',
        'currency' => 'mdl',
        'language' => 'ro',
        'description' => 'Testare Nutrițională și Funcțională',
        'country_code' => 'md'
    ]
];
