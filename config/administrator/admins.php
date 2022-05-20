<?php

use Illuminate\Database\Eloquent\Builder;

return [
    'title'       => 'Administratori',
    'model'       => 'App\User',
    'permission'  => function (\Illuminate\Contracts\Auth\Guard $guard) {
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
    'columns'     => [
        'id',
        'info'   => [
            'title'      => 'Info',
            'sort_field' => 'name',
            'elements'   => [
                'name'  => ['standalone' => true],
                'email' => [
                    'output' => '<a href="mailto:(:email)">(:email)</a>',
                ],
                'name'
            ]
        ],
        'active' => [
            'visible' => function () {
            },
            'output'  => function ($row) {
                return output_boolean($row);
            }
        ],
        'dates'  => [
            'elements' =>
                [
                    'created_at' => [
                        'output' => function ($row) {
                            return $row->created_at->diffForHumans();
                        }
                    ],
                    'updated_at' => [
                        'output' => function ($row) {
                            return $row->updated_at->diffForHumans();
                        }
                    ]
                ]
        ]
    ],
    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    |
    */
    'actions'     => [],
    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with'        => [],
    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query'       => function (Builder $query) {
        $query->where('role', '=', 'admin');
    },
    /*
    |-------------------------------------------------------
    | Global filter
    |-------------------------------------------------------
    */
    'filters'     => [
        'name'       => [
            'type'  => 'text',
            'query' => function ($query, $value = '') {
                $query->where('users.name', '=', $value);
            }
        ],
        'active'     => [
            'type'    => 'select',
            'options' => [
                '' => '-- Any --',
                0  => 'No',
                1  => 'Yes'
            ]
        ],
        'created_at' => [
            'type' => 'date'
        ]
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
        'id'     => ['type' => 'key'],
        'role'   => ['type' => 'hidden', 'value' => 'admin'],
        'name'   => [
            'type' => 'text'
        ],
        'email'  => [
            'type' => 'email'
        ],
        'password' => [
            'type'        => 'password',
            'description' => 'To change:<br />Leave empty for auto generating<br />Or enter a new password'
        ],
        'active' => [
            'title' => 'Active',
            'type'  => 'bool'
        ]
    ]
];