<?php

return [
    'title'       => 'Site',
    'model'       => 'Terranet\Administrator\Model\Settings',
    'rules'       => [
        'admin::email'   => 'required|email',
        'support::email' => 'required|email'
    ],
    'edit_fields' => [
        'admin::email'   => ['type' => 'email'],
        'support::email' => ['type' => 'email'],
    ]
];