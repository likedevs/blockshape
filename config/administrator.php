<?php

use Illuminate\Contracts\Auth\Guard;

return [
    'prefix'          => 'admin',
    'title'           => 'UnicaSport.com',
    'auth_identity'   => 'email',
    'auth_credential' => 'password',
    'auth_conditions' => [
        'active' => 1,
        'role'   => function () {
            return ['admin', 'manager'];
        }
    ],
    'auth_model'      => 'App\User',
    /**
     * The path to your model config directory
     *
     * @type string
     */
    'models_path'     => app('path.config') . '/administrator',
    /**
     * The path to your settings config directory
     *
     * @type string
     */
    'settings_path'   => app('path.config') . '/administrator/settings',
    'assets_path'     => 'administrator',
    /**
     * Basic user validation
     */
    'permission'      => function (Guard $user) {
        if ($user->check() && $user->user()->isInstructor()) {
            return redirect()->to('/home');
        }

        return (! $user->guest() && ($user->user()->isAdmin() || $user->user()->isManager()));
    },
    /**
     * The menu item that should be used as the default landing page of the administrative section
     *
     * @type string
     */
    'home_page'       => 'admin/history_records',
    /**
     * Default locale
     */
    'locale'          => 'en',
    'rows_per_page'   => 20,
    /**
     * Enable Admin Event subscriber
     */
    'subscriber'      => '\Terranet\Administrator\Subscriber\AdminSubscriber',
    'log_actions'     => false
];