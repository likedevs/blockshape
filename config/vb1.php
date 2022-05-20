<?php

return array(

    /**
     * If debug mode is on than authorize form is displayed for user.
     *
     */
    'debug' => false,

    /**
     * Callback VB url. That url is used for VictoriaBank response .
     *
     */
    'call_back_url' => 'vb-callback',


    /**
     * Default language .
     *
     * by default available only array('ro', 'ru', 'en') languages .
     *
     */
    'language' => 'ro',

    /**
     * Merchant shop 2-character country code . Must be provided if merchant system is located in a
     *  country other than the gateway server's country
     *
     */
    'country' => 'MD',

    /**
     * Default currency .
     *  3-character currency code .
     *
     */
    'currency' => 'EUR',

    /**
     * Redirect user after enter card details
     *  That options is not required. it can be passed directly to vbService class .
     *
     */
    'back_ref' => '/payment/success',

    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Merchant Bank Information                                          *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    /** Merchant ID assigned by bank */
    'merchant_id' => '498000049802083',

    /** Merchant name (recognizable by cardholder) */
    'merchant_name' => 'UnicaSport',

    /** Merchant primary website URL in format ( http://www.merchantsitename.domain ) */
    'merchant_url' => 'http://unica.likemedia.md',

    /** Merchant company registered office address */
    'merchant_address' => 'Republica Moldova, Chisinau str. Stefan cel Mare 182, Centru de Moda, birou 505',

    /** Merchant terminal ID assigned by bank */
    'merchant_terminal_id' => '49802083',

    /** Merchant UTC / GMT timezone offset (e.g -3) */
    'merchant_gmt' => '+2', // Europe/Chisinau

    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Security Default Settings                                          *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    /** Hash prefix */
    'hash' => '003020300C06082A864886F70D020505000410',

    /** Prefix number */
    'prefix' => '0001',

    /** Bank response prefix number */
    'response_prefix' => '3020300C06082A864886F70D020505000410',

    /** Public key relative path . */
    'public_key_path' => 'storage/app/public.pem',

    /** Private key relative path .  */
    'private_key_path' => 'storage/app/private.pem',

    /** Public bank key path . */
    'public_bank_key_path' => 'storage/app/victoria.pem',
);
