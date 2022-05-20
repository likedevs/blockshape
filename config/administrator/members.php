<?php

use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

return [
    'title' => 'Utilizatori',
    'model' => 'App\User',
    'permission' => function (\Illuminate\Contracts\Auth\Guard $guard) {
        return $guard->check() && $guard->user()->isAdmin();
    },
    /*
    |-------------------------------------------------------
    | Columns/Groups
    |-------------------------------------------------------
    |
    | Describe here full list of columns that should be presented
    | on main listing page
    |
    */
    'columns' => [
        'id',
        'name',
        'email',
        'phone' => [
            'output' => '<a href="mailto:(:email)">(:email)</a>',
        ],
        'type' => ['output' => function ($user) {
            return $user->isOnline() ? html_label('Online', 'label-info') : '';
        }],
        'birth_date' => [
            'title' => 'Age',
            'output' => function ($row) {
                $date = Carbon::createFromTimestamp(strtotime($row->birth_date));
                $years = $date->diffInYears();

                return sprintf(trans_choice('%d year|%d years|%d years', $years), $years);
            },
        ],
    ],
    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    | @todo
    */
    'actions' => [],
    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with' => [],
    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function (Builder $query) {
        if (! Request::has('site_id')) {
            $query->whereSiteId(site_id());
        }

        $query->whereRole('member');

        return $query;
    },
    /*
    |-------------------------------------------------------
    | Global filter
    |-------------------------------------------------------
    |
    | Filters should be defined here
    |
    */
    'filters' => [
        'site_id' => sites_control(),
        'id' => ['type' => 'number', 'min' => 0, 'step' => 1],
        'name' => ['type' => 'text'],
        'email' => ['type' => 'text'],
        'phone' => ['type' => 'text'],
        'role' => [
            'type' => 'select',
            'options' => function () {
                return [
                    '' => '-- Any --',
                    'online' => 'Utilizatori Online',
                    'offline' => 'Utilizatori din Sala',
                ];
            },
            'query' => function ($query, $value) {
                return 'online' == $value
                    ? $query->onlineCustomer()
                    : $query->offlineCustomer();
            },
            'multiple' => false,
        ],
        'active' => [
            'type' => 'select',
            'options' => [
                '' => '-- Any --',
                0 => 'No',
                1 => 'Yes',
            ],
        ],
        'created_at' => ['type' => 'date'],
    ],
    /*
    |-------------------------------------------------------
    | Editable area
    |-------------------------------------------------------
    |
    | Describe here all fields that should be editable
    |
    */
    'edit_fields' => [
        'id' => ['type' => 'key'],
        'email' => ['type' => 'email'],
        'name' => ['type' => 'text'],
        'image' => [
            'type' => 'image',
            'location' => '/glide/members',
            'value' => function ($row) {
                if ($row->attributes['image']) {
                    return $row->imageUrl(\App\User::IMAGE_SIZE_MEDIUM);
                }

                return '';
            },
        ],
        'phone' => ['type' => 'tel'],
        'birth_date' => ['type' => "date"],
        'active' => [
            'title' => 'Active',
            'type' => 'bool',
        ],
    ],
];